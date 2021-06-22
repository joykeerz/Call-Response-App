<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $client = Client::all();
        return view('Client.index', ['cl' => $client]);
    }

    public function store(Request $request)
    {
        $client = Client::firstOrNew(['client_customer_name' => $request->tb_customer_name]);
        $client->client_customer_name = $request->tb_customer_name;
        $client->client_site_location_name = $request->tb_site_location;
        $client->client_site_location_address = $request->tb_site_address;
        $client->save();
        return redirect()->route('cl.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = Client::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->client_customer_name = $request->tbCustomerName;
        $client->client_site_location_name = $request->tbSiteLocation;
        $client->client_site_location_address = $request->tbSiteAddress;
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
