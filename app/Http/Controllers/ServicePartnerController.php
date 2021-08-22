<?php

namespace App\Http\Controllers;

use App\Sp;
use Illuminate\Http\Request;

class ServicePartnerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sps = Sp::all();
        return view('ServicePartner.index', ['sps' => $sps]);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tb_company_name' => 'required',
            'tb_company_address' => 'required',
            'tb_bank_name' => 'required'
        ]);

        $sps = new Sp();
        $sps->sp_company_name = $request->tb_company_name;
        $sps->sp_company_address = $request->tb_company_address;

        if (!empty($request->tb_pic_name)) {
            $arrayPicName = join(',', $request->tb_pic_name);
            $sps->sp_pic_name = $arrayPicName;
        } else {
            $sps->sp_pic_name = '';
        }

        if (!empty($request->tb_contact_number)) {
            $arrayPicContact = join(',', $request->tb_contact_number);
            $sps->sp_contact_number = $arrayPicContact;
        } else {
            $sps->sp_contact_number = 'none';
        }

        if (!empty($request->tb_email)) {
            $arrayPicEmail = join(',', $request->tb_email);
            $sps->sp_email = $arrayPicEmail;
        } else {
            $sps->sp_email = 'none';
        }

        $sps->sp_bank_name = $request->tb_bank_name;
        $sps->save();
        return redirect()->route('sp.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = Sp::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $bps = Sp::find($id);
        $bps->sp_company_name = $request->tb_sp_company_name;
        $bps->sp_company_address = $request->tb_sp_company_address;
        $bps->sp_pic_name = $request->tb_sp_pic_name;
        $bps->sp_contact_number = $request->tb_sp_contact_number;
        $bps->sp_email = $request->tb_sp_email;
        $bps->sp_bank_name = $request->tb_sp_bank_name;
        $bps->save();
        return redirect()->route('sp.index')->with('message', 'data successfuly updated');
    }

    public function delete($id)
    {
        $bps = Sp::find($id);
        $bps->delete();
        return redirect()->route('sp.index')->with('message', 'data successfuly deleted');
    }
}
