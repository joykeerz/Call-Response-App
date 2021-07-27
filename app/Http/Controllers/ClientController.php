<?php

namespace App\Http\Controllers;

use App\Client;
use App\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clients = Client::all();
        $products = ProductDetail::all();
        return view('Client.index', ['cl' => $clients, 'products' => $products]);
    }

    public function store(Request $request)
    {
        $client = Client::firstOrNew(['client_customer_name' => $request->tb_customer_name]);
        $client->product_detail_id = $request->cb_product;
        $client->client_customer_name = $request->tb_customer_name;
        $client->client_machine_id = $request->tb_machine_id;
        $client->client_machine_status = $request->cb_machine_status;
        $client->client_pic_name = $request->tb_pic_name;
        $client->client_pic_hp = $request->tb_pic_hp;
        $client->client_site_location_name = $request->tb_site_location;
        $client->client_site_location_address = $request->tb_site_address;
        $client->client_activation_date = $request->dt_activation_date;
        $client->save();
        return redirect()->route('cl.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->select('product_details.*', 'clients.*')
            ->where('clients.id', '=', $id)
            ->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->product_detail_id = $request->cbProduct;
        $client->client_customer_name = $request->tbCustomerName;
        $client->client_machine_id = $request->tbMachineId;
        $client->client_machine_status = $request->cbMachineStatus;
        $client->client_pic_name = $request->tbPicName;
        $client->client_pic_hp = $request->tbPicHp;
        $client->client_site_location_name = $request->tbSiteLocation;
        $client->client_site_location_address = $request->tbSiteAddress;
        $client->client_activation_date = $request->dtActivationDate;
        $client->save();
        return redirect()->route('cl.index')->with('message', 'data successfuly added');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('cl.index')->with('message', 'data successfuly deleted');
    }
}
