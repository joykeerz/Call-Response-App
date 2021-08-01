<?php

namespace App\Http\Controllers;

use App\CustomerServiceEngineer;
use App\Sp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerServiceEngineerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cse = DB::table('customer_service_engineers')
            ->join('sps', 'customer_service_engineers.sp_id', '=', 'sps.id')
            ->select('customer_service_engineers.*', 'sps.*')
            ->get();
        $sp = Sp::all();
        return view('CustomerServiceEngineer.index', ['cse' => $cse, 'sps' => $sp]);
        # code...
    }

    public function store(Request $request)
    {
        $cse = new CustomerServiceEngineer;
        $cse->nama_cse = $request->tb_cse_name;
        $cse->initial_cse = $request->tb_cse_initial;
        $cse->area_cse = $request->tb_cse_area;
        $cse->hp_cse = $request->tb_cse_hp;
        $cse->sp_id = $request->cb_sp;
        $cse->save();
        return redirect()->route('cse.index')->with('message', 'Data successfuly created');
    }

    public function edit($id)
    {
        // $data = CustomerServiceEngineer::find($id);
        $data = DB::table('customer_service_engineers')
            ->join('sps', 'customer_service_engineers.sp_id', '=', 'sps.id')
            ->select('customer_service_engineers.*', 'sps.*')
            ->where('customer_service_engineers.id', $id)
            ->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $cse = CustomerServiceEngineer::find($id);
        $cse->nama_cse = $request->tbCseName;
        $cse->initial_cse = $request->tbCseInitial;
        $cse->area_cse = $request->tbCseArea;
        $cse->hp_cse = $request->tbCseHp;
        $cse->sp_id = $request->cbSp;
        $cse->save();
        return redirect()->route('cse.index')->with('message', 'Data successfuly updated');
    }

    public function delete($id)
    {
        $cse = CustomerServiceEngineer::find($id);
        $cse->delete();
        return redirect()->route('cse.index')->with('message', 'Data successfuly deleted');
    }
}
