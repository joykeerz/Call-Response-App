<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetail;

class ProductDetailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productDetails = ProductDetail::all();
        return view('Product.index', ['pd' => $productDetails]);
    }
    public function store(Request $request)
    {
        $productDetail = ProductDetail::firstOrNew(['serial_number' => $request->tb_serial_number]);
        $productDetail->product_name = $request->tb_product_name;
        $productDetail->brand_name = $request->tb_brand_name;
        $productDetail->type_series = $request->tb_type_series;
        $productDetail->serial_number = $request->tb_serial_number;
        $productDetail->id_number = $request->tb_id_number;
        $productDetail->date_of_entry = $request->tb_entry_date;
        $productDetail->activation_date = $request->tb_activation_date;
        $productDetail->save();
        return redirect()->route('pd.index')->with('message', 'data successfuly added');
    }

    public function edit($id)
    {
        $data = ProductDetail::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $productDetail = ProductDetail::find($id);
        $productDetail->product_name = $request->tb_pd_product_name;
        $productDetail->brand_name = $request->tb_pd_brand_name;
        $productDetail->type_series = $request->tb_pd_type_series;
        $productDetail->serial_number = $request->tb_pd_serial_number;
        $productDetail->id_number = $request->tb_pd_id_number;
        $productDetail->date_of_entry = $request->tb_pd_entry_date;
        $productDetail->activation_date = $request->tb_pd_activation_date;
        $productDetail->save();
        return redirect()->route('pd.index')->with('message', 'data successfuly updated');
    }

    public function delete($id)
    {
        $productDetail = ProductDetail::find($id);
        $productDetail->delete();
        return redirect()->route('pd.index')->with('message', 'data successfuly deleted');
    }
}
