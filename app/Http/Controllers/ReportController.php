<?php

namespace App\Http\Controllers;

use App\Bp;
use App\CustomerServiceEngineer;
use App\ProductDetail;
use App\Sp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('reports.reports');
    }

    public function bpReport()
    {
        $bps = Bp::all();
        return view('reports.bpReport', ['bps' => $bps]);
    }

    public function bpReportFilter(Request $request)
    {
        $bps = Bp::whereBetween('created_at', [$request->min, $request->max])->get();
        return view('reports.bpReport', ['bps' => $bps]);
    }

    public function spReport()
    {
        $sps = Sp::all();
        return view('reports.spReport', ['sps' => $sps]);
    }

    public function spReportFilter(Request $request)
    {
        $sps = Sp::whereBetween('created_at', [$request->min, $request->max])->get();
        return view('reports.spReport', ['sps' => $sps]);
    }

    public function pdReport()
    {
        $productDetails = ProductDetail::all();
        return view('reports.pdReport', ['pd' => $productDetails]);
    }

    public function pdReportFilter(Request $request)
    {
        $productDetails = ProductDetail::whereBetween('date_of_entry', [$request->min, $request->max])->get();
        return view('reports.pdReport', ['pd' => $productDetails]);
    }

    public function spsReport()
    {
        // $spareparts = Sparepart::all();
        $products = ProductDetail::all();
        $spareparts = DB::table('spareparts')
            ->join('product_details', 'spareparts.product_detail_id', '=', 'product_details.id')
            ->select('spareparts.*', 'product_details.*', 'spareparts.id AS spid', 'product_details.id AS pdid')
            ->get();
        return view('reports.spsReport', ['spareparts' => $spareparts, 'products' => $products]);
    }
    public function spsReportFilter(Request $request)
    {
        // $spareparts = Sparepart::all();
        $products = ProductDetail::all();
        $spareparts = DB::table('spareparts')
            ->join('product_details', 'spareparts.product_detail_id', '=', 'product_details.id')
            ->select('spareparts.*', 'product_details.*', 'spareparts.id AS spid', 'product_details.id AS pdid')
            ->whereBetween('part_date_of_entry', [$request->min, $request->max])
            ->get();
        return view('reports.spsReport', ['spareparts' => $spareparts, 'products' => $products]);
    }

    public function clientReport()
    {
        // $clients = Client::all();
        $products = ProductDetail::all();
        $cse = CustomerServiceEngineer::all();
        $clients = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->join('customer_service_engineers', 'clients.customer_service_engineer_id', '=', 'customer_service_engineers.id')
            ->select('product_details.*', 'clients.*', 'customer_service_engineers.*', 'clients.id AS cid', 'customer_service_engineers.id AS cseid', 'product_details.id AS pdid')
            ->get();
        return view('reports.clientReport', ['clients' => $clients, 'products' => $products, 'cse' => $cse]);
    }

    public function clientReportFilter(Request $request)
    {
        // $clients = Client::all();
        $products = ProductDetail::all();
        $cse = CustomerServiceEngineer::all();
        $clients = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->join('customer_service_engineers', 'clients.customer_service_engineer_id', '=', 'customer_service_engineers.id')
            ->select('product_details.*', 'clients.*', 'customer_service_engineers.*', 'clients.id AS cid', 'customer_service_engineers.id AS cseid', 'product_details.id AS pdid')
            ->whereBetween('client_activation_date', [$request->min, $request->max])
            ->get();
        return view('reports.clientReport', ['clients' => $clients, 'products' => $products, 'cse' => $cse]);
    }

    public function cseReport()
    {
        $cse = DB::table('customer_service_engineers')
            ->join('sps', 'customer_service_engineers.sp_id', '=', 'sps.id')
            ->select('customer_service_engineers.*', 'sps.*', 'customer_service_engineers.id AS cseid', 'sps.id AS spsid')
            ->get();
        $sp = Sp::all();
        return view('reports.cseReport', ['cse' => $cse, 'sps' => $sp]);
    }

    public function cseReportFilter(Request $request)
    {
        # code...
        $cse = DB::table('customer_service_engineers')
            ->join('sps', 'customer_service_engineers.sp_id', '=', 'sps.id')
            ->select('customer_service_engineers.*', 'sps.*', 'customer_service_engineers.id AS cseid', 'sps.id AS spsid')
            ->whereBetween('customer_service_engineers.created_at', [$request->min, $request->max])
            ->get();
        $sp = Sp::all();
        return view('reports.cseReport', ['cse' => $cse, 'sps' => $sp]);
    }
}
