<?php

namespace App\Http\Controllers;

use App\Client;
use App\CustomerServiceEngineer;
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
        // $clients = Client::all();
        $products = ProductDetail::all();
        $cse = CustomerServiceEngineer::all();
        $clients = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->join('customer_service_engineers', 'clients.customer_service_engineer_id', '=', 'customer_service_engineers.id')
            ->select('product_details.*', 'clients.*', 'customer_service_engineers.*', 'clients.id AS cid', 'customer_service_engineers.id AS cseid', 'product_details.id AS pdid')
            ->get();
        return view('Client.index', ['clients' => $clients, 'products' => $products, 'cse' => $cse]);
    }

    public function store(Request $request)
    {
        $client = Client::firstOrNew(['client_customer_name' => $request->tb_customer_name]);
        $client->product_detail_id = $request->cb_product;
        $client->client_customer_name = $request->tb_customer_name;
        $client->client_machine_id = $request->tb_machine_id;
        $client->client_machine_status = 'new installation';
        $client->client_pic_name = $request->tb_pic_name;
        $client->client_pic_hp = $request->tb_pic_hp;
        $client->client_site_location_name = $request->tb_site_location;
        $client->client_site_location_address = $request->tb_site_address;
        $client->client_activation_date = $request->dt_activation_date;
        $client->customer_service_engineer_id = $request->cb_cse;
        $client->client_warranty_year = $request->cb_warranty;
        $client->client_operation_hours = $request->cb_operational_hours;
        $client->save();
        return redirect()->route('cl.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->join('customer_service_engineers', 'clients.customer_service_engineer_id', '=', 'customer_service_engineers.id')
            ->select('product_details.*', 'clients.*', 'customer_service_engineers.*', 'clients.id AS cid', 'customer_service_engineers.id AS cseid', 'product_details.id AS pdid')
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
        $client->customer_service_engineer_id = $request->cbCse;
        $client->product_detail_id = $request->cbProduct;
        $client->client_warranty_year = $request->cbWarranty;
        $client->client_operation_hours = $request->cbOperationalHours;
        $client->save();
        return redirect()->route('cl.index')->with('message', 'data successfuly added');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('cl.index')->with('message', 'data successfuly deleted');
    }

    public function moveMachine(Request $request)
    {
        $oldClient = Client::find($request->tb_client_id);

        $moveClient = new Client;
        $moveClient->client_customer_name = $request->tb_customer_name;
        $moveClient->client_machine_id = $request->tb_machine_id;
        $moveClient->client_pic_name = $request->tb_pic_name;
        $moveClient->client_pic_hp = $request->tb_pic_hp;
        $moveClient->client_activation_date = $request->dt_activation_date;
        $moveClient->customer_service_engineer_id = $request->cb_cse;
        $moveClient->product_detail_id = $oldClient->product_detail_id;
        $moveClient->client_machine_status = 'moved';
        $moveClient->client_site_location_name = $request->tb_site_location;
        $moveClient->client_site_location_address = $request->tb_site_address;
        $moveClient->client_warranty_year = $oldClient->client_warranty_year;
        $moveClient->client_operation_hours = $oldClient->client_operation_hours;
        $moveClient->save();
        return redirect()->route('cl.index')->with('message', 'moved successfuly');
    }

    public function showRelocateClient($id)
    {
        $cse = CustomerServiceEngineer::all();
        $clients = DB::table('clients')
            ->join('product_details', 'clients.product_detail_id', '=', 'product_details.id')
            ->join('customer_service_engineers', 'clients.customer_service_engineer_id', '=', 'customer_service_engineers.id')
            ->select('product_details.*', 'clients.*', 'customer_service_engineers.*', 'clients.id AS cid', 'customer_service_engineers.id AS cseid', 'product_details.id AS pdid')
            ->where('clients.id', '=', $id)
            ->first();
        return view('Client.relocate', ['client' => $clients, 'cse' => $cse]);
    }
}
