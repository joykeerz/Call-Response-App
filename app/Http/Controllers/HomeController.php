<?php

namespace App\Http\Controllers;

use App\Jobcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalTicket = Jobcard::all()->count();
        $pendingTicket = Jobcard::where('status', 'Pending')->count();
        $resolvedTicket = Jobcard::where('status', 'Complete')->count();
        $respondedTicket = Jobcard::where('isClosed', 1)->count();

        $jobcards = DB::table('jobcards')
            ->join('clients', 'jobcards.client_id', '=', 'clients.id')
            ->join('bps', 'jobcards.bp_id', '=', 'bps.id')
            ->join('sps', 'jobcards.sp_id', '=', 'sps.id')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->select('clients.*', 'bps.*', 'sps.*',  'product_details.*', 'jobcards.*')
            ->get();
        return view('main.index', [
            'jobcards' => $jobcards,
            'totalTicket' => $totalTicket,
            'pendingTicket' => $pendingTicket,
            'resolvedTicket' => $resolvedTicket,
            'respondedTicket' => $respondedTicket
        ]);
    }

    public function mainMenu()
    {
        return view('main.menu');
    }
}
