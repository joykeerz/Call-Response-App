<?php

namespace App\Http\Controllers;

use App\Bp;
use Illuminate\Http\Request;

class BusinessPartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bps = Bp::all();
        return view('businessPartner.index', ['bps' => $bps]);
    }

    public function store(Request $request)
    {
        $bps = Bp::firstOrNew(['bp_company_name' => $request->tb_company_name]);
        $bps->bp_company_name = $request->tb_company_name;
        $bps->bp_company_address = $request->tb_company_address;
        $bps->bp_pic_name = $request->tb_pic_name;
        $bps->bp_contact_number = $request->tb_contact_number;
        $bps->save();
        return redirect()->route('bp.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = bp::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $bps = Bp::find($id);
        $bps->bp_company_name = $request->tb_bp_company_name;
        $bps->bp_company_address = $request->tb_bp_company_address;
        $bps->bp_pic_name = $request->tb_bp_pic_name;
        $bps->bp_contact_number = $request->tb_bp_contact_number;
        $bps->save();
        return redirect()->route('bp.index')->with('message', 'data successfuly updated');
    }

    public function delete($id)
    {
        $bps = Bp::find($id);
        $bps->delete();
        return redirect()->route('bp.index')->with('message', 'data successfuly deleted');
    }
}
