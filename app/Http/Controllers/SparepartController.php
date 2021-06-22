<?php

namespace App\Http\Controllers;

use App\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $spareparts = Sparepart::all();
        return view('Sparepart.index', ['spareparts' => $spareparts]);
    }

    public function store(Request $request)
    {
        $spareparts = Sparepart::firstOrNew(['part_serial' => $request->tb_serial_number]);
        $spareparts->part_number = $request->tb_part_number;
        $spareparts->part_serial = $request->tb_serial_number;
        $spareparts->part_name = $request->tb_part_name;
        $spareparts->part_date_of_entry = $request->tb_date_entry;
        $spareparts->part_out_date = $request->tb_date_out;
        $spareparts->part_condition = $request->cb_condition;
        $spareparts->save();
        return redirect()->route('spp.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = Sparepart::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $spareparts = Sparepart::find($id);
        $spareparts->part_number = $request->tbPartNumber;
        $spareparts->part_serial = $request->tbSerialNumber;
        $spareparts->part_name = $request->tbPartName;
        $spareparts->part_date_of_entry = $request->tbDateEntry;
        $spareparts->part_out_date = $request->tbDateOut;
        $spareparts->part_condition = $request->cbCondition;
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
