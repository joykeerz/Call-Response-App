<?php

namespace App\Http\Controllers;

use App\Bp;
use App\Client;
use App\CustomerServiceEngineer;
use App\Jobcard;
use App\ProductDetail;
use App\Sp;
use App\Sparepart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobcardController extends Controller
{
    //
    public function stepOne()
    {
        $machineData = ProductDetail::all();
        $customerData = Client::all();
        $bpData = Bp::all();
        $spData = Sp::all();
        return view('Jobcard.index', [
            'machineData' => $machineData,
            'customerData' => $customerData,
            'spData' => $spData,
            'bpData' => $bpData,
        ]);
    }

    public function stepOneStore(Request $request)
    {
        $jobcardId = DB::table('jobcards')->insertGetId([
            'client_id' => $request->tb_customer,
            // 'product_detail_id' => $request->tb_id_number,
            'bp_id' => $request->cb_bp,
            'sp_id' => $request->cb_sp,

            // 'pic_contact' => $request->tb_pic,
            'problem_desc' => $request->tb_problem_desc,
            'date_time' => $request->tb_date_time,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('jobcard.stepTwoGet', $jobcardId);
    }

    public function stepTwo($id)
    {
        $cseData = CustomerServiceEngineer::all();
        return view('Jobcard.step2', [
            'jobcardId' => $id,
            'cseData' => $cseData
        ]);
    }

    public function stepTwoStore(Request $request)
    {
        $jobcard = Jobcard::find($request->tb_id);
        $jobcard->jobcard_number = $request->tb_jobcard_number;

        if (!empty($request->cb_service_type)) {
            // $dataJobcardStatus = [];
            // foreach ($request->cb_service_type as $key => $value) {
            //     array_push($dataJobcardStatus, [
            //         'service_type' => $value,
            //         'jobcard_id' => $request->tb_id,
            //     ]);
            //     DB::table('service_type_details')->insert($dataJobcardStatus)
            // }
            $dataJobcardStatus = join(',', $request->cb_service_type);
            $jobcard->service_type = $dataJobcardStatus;
        }

        $jobcard->ticket_number = $request->tb_ticket_number;
        $jobcard->arrival_time = $request->dt_arrival_time;
        $jobcard->time_working = $request->dt_working_time;
        $jobcard->time_complete = $request->dt_complete_time;
        $jobcard->time_leave = $request->dt_leave_time;
        $jobcard->waiting_time = $request->dt_waiting_time;
        $jobcard->waiting_note = $request->tb_waiting_note;
        $jobcard->status = $request->cb_status;

        $jobcard->remarks = $request->tb_remarks;
        $jobcard->brief_of_work = $request->tb_brief;
        $jobcard->cse_name = $request->tb_cse_name;

        if ($request->cbx_sparepart) {
            $jobcard->sparepart_replacement = 1;
            $route = 'jobcard.stepThreeGet';
        } else {
            $jobcard->sparepart_replacement = 0;
            $route = 'jobcard.jobcardDetail';
        }

        $jobcard->save();

        return redirect()->route($route, $request->tb_id);
    }

    public function stepThree($id)
    {
        $spareparts = Sparepart::all();
        return view('Jobcard.step3', ['jobcardId' => $id, 'spareparts' => $spareparts]);
    }

    public function stepThreeStore(Request $request, $id)
    {
        $dataSparepartReplace = [];
        for ($i = 0; $i < count($request->cb_part_number); $i++) {
            array_push($dataSparepartReplace, [
                "jobcard_id" => $id,
                "sparepart_id" => $request->cb_part_number[$i],
                "qty" => $request->tb_qty[$i],
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }
        DB::table('replacements')->insert($dataSparepartReplace);
        return redirect()->route('jobcard.jobcardDetail', $id)->with('message', 'jobcard successfuly created');
    }

    public function jobcardDetail($id)
    {
        $jobcards = DB::table('jobcards')
            ->join('clients', 'jobcards.client_id', '=', 'clients.id')
            ->join('bps', 'jobcards.bp_id', '=', 'bps.id')
            ->join('sps', 'jobcards.sp_id', '=', 'sps.id')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->select('clients.*', 'bps.*', 'sps.*',  'product_details.*', 'jobcards.*')
            ->where('jobcards.id', '=', $id)
            ->first();

        $spareparts = DB::table('replacements')
            ->join('spareparts', 'replacements.sparepart_id', '=', 'spareparts.id')
            ->join('jobcards', 'replacements.jobcard_id', '=', 'jobcards.id')
            ->select('spareparts.*', 'replacements.*')
            ->where('jobcards.id', '=', $id)
            ->get();
        return view('Jobcard.detail', ['jobcards' => $jobcards, 'spareparts' => $spareparts]);
    }

    public function closeTicket($id)
    {
        $jobcard = Jobcard::find($id);
        $jobcard->isClosed = 1;
        $jobcard->save();
        return redirect()->route('jobcard.jobcardDetail', $id)->with('message', 'ticket successfuly closed');
    }

    public function countWaitingTime(Request $request)
    {

        $start = Carbon::parse($request->dt_arrival_time);
        $end = Carbon::parse($request->dt_working_time);
        $waiting = $end->diffForHumans($start);
        return response()->json($waiting);
    }

    public function getClientDataAjax($id)
    {
        $client = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->select('product_details.*', 'clients.*')
            ->where('clients.id', '=', $id)
            ->first();
        return response()->json($client);
    }

    public function cancelTicket($id)
    {
        $jobcard = Jobcard::find($id);
        $jobcard->delete();
        return redirect()->route('home');
    }
}
