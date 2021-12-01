<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $spareparts = Sparepart::all();
        // $products = ProductDetail::all();
        $products = DB::table('product_details')
            ->select('id', 'product_name', 'brand_name', 'type_series')
            ->distinct('product_name')
            ->get();
        $spareparts = DB::table('spareparts')
            ->join('product_details', 'spareparts.product_detail_id', '=', 'product_details.id')
            ->select('spareparts.*', 'product_details.*', 'spareparts.id AS spid', 'product_details.id AS pdid')
            ->get();
        return view('Sparepart.index', ['spareparts' => $spareparts, 'products' => $products]);
    }

    public function store(Request $request)
    {
        $spareparts = Sparepart::firstOrNew(['part_serial' => $request->tb_serial_number]);
        $spareparts->product_detail_id = $request->cb_product;
        $spareparts->part_number = $request->tb_part_number;
        $spareparts->part_serial = $request->tb_serial_number;
        $spareparts->part_name = $request->tb_part_name;
        $spareparts->part_qty = $request->tb_part_qty;
        $spareparts->part_condition = $request->cb_condition;
        $spareparts->part_module = $request->tb_part_module;
        $spareparts->part_date_of_entry = $request->tb_date_entry;
        // $spareparts->part_out_date = $request->tb_date_out;
        $spareparts->save();
        return redirect()->route('spp.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = DB::table('spareparts')
            ->join('product_details', 'spareparts.product_detail_id', '=', 'product_details.id')
            ->select('spareparts.*', 'product_details.*')
            ->where('spareparts.id', '=', $id)
            ->first();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $spareparts = Sparepart::find($id);
        $spareparts->part_number = $request->tbPartNumber;
        $spareparts->part_serial = $request->tbSerialNumber;
        $spareparts->part_name = $request->tbPartName;
        $spareparts->part_condition = $request->cbCondition;
        $spareparts->part_qty = $request->tbPartQty;
        $spareparts->part_module = $request->tbPartModule;
        $spareparts->product_detail_id = $request->cbProduct;
        $spareparts->part_date_of_entry = $request->tbDateEntry;
        // $spareparts->part_out_date = $request->tbDateOut;
        $spareparts->save();
        return redirect()->route('spp.index')->with('message', 'data successfuly updated');
    }

    public function delete($id)
    {
        $bps = Sparepart::find($id);
        $bps->delete();
        return redirect()->route('spp.index')->with('message', 'data successfuly deleted');
    }
}
