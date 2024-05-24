<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id = Auth::user()->id;
        $products = Product::where('user_id', '=', $id)->get();
        return view('marchant.pages.delivery-table', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $id = Auth::id();
        $uuid = Uuid::uuid4()->toString();
        $uuid = str_replace("-", "", $uuid);
        $firstFiveChars = substr($uuid, 0, 5);
        $numericValue = hexdec($firstFiveChars);
        return view('marchant.pages.delivery-create', compact('id', 'numericValue'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_category' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'full_address' => 'required|string|max:255',
            'divisions' => 'required|string',
            'district' => 'required|string',
            'police_station' => 'required|string',
            'delivery_type' => 'required|string',
            'cod_amount' => 'required|numeric',
            'invoice' => 'required|string',
            'note' => 'required|string',
            'product_weight' => 'required',
            'exchange_status' => 'required',
            'delivery_charge' => 'required',
        ]);
        $product = new Product($request->all());
        $product->save();

        return redirect()->route('product.index')->with('success', 'Delivery created successfully.');
    }
    public function show(Product $product)
    {

        return view('marchant.pages.delivery-show', compact('product'));
    }

    public function edit(Product $product)
    {

        return view('marchant.pages.delivery-edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {

        $product->update($request->all());
        return redirect('product')->withSuccess('Update successfully.');
    }

    public function destroy(Product $product)
    {

        $product->delete();
        return redirect('product')->withSuccess('Delete successfully.');
    }
}
