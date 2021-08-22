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
        $validateData = $request->validate([
            'tb_company_name' => 'required',
            'tb_company_address' => 'required',
            'tb_bank_name' => 'required'
        ]);

        $bps = new Bp();
        $bps->bp_company_name = $request->tb_company_name;
        $bps->bp_company_address = $request->tb_company_address;

        if (!empty($request->tb_pic_name)) {
            $arrayPicName = join(',', $request->tb_pic_name);
            $bps->bp_pic_name = $arrayPicName;
        } else {
            $bps->bp_pic_name = $request->tb_pic_name;
        }

        if (!empty($request->tb_contact_number)) {
            $arrayPicContact = join(',', $request->tb_contact_number);
            $bps->bp_contact_number = $arrayPicContact;
        } else {
            $bps->bp_contact_number = 'none';
        }

        if (!empty($request->tb_email)) {
            $arrayPicEmail = join(',', $request->tb_email);
            $bps->bp_email = $arrayPicEmail;
        } else {
            $bps->bp_email = 'none';
        }

        $bps->bp_bank_name = $request->tb_bank_name;
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
        $bps->bp_email = $request->tb_bp_email;
        $bps->bp_bank_name = $request->tb_bp_bank_name;
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
