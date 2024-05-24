<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Mail\SendCustomerMail;
use App\Models\Hub;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
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

        $firstTwoChars = substr($uuid, 0, 2);
        $lastFiveChars = substr($uuid, -5);
        $lettersValue = hexdec($firstTwoChars);

        $firstTwoChars = preg_replace("/[^a-zA-Z]/", "", $firstTwoChars);
        $lastFiveChars = preg_replace("/[^0-9]/", "", $lastFiveChars);

        $uniqueValue = $firstTwoChars . $lastFiveChars;

        $hubs = Hub::all();

        return view('marchant.pages.delivery-create', compact('id', 'numericValue', 'hubs', 'uniqueValue'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_category' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'customer_email' => 'required',
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
        ]);
        $number = mt_rand(1000000000, 9999999999);
        
        if($this->productCodeExists($number)){
            $number = mt_rand(1000000000, 999999999);
        }
        $request['product_bar_code'] = $number;

        $product = new Product($request->all());
        // dd($product);
        $product->save();

        return redirect()->route('product.index')->with('success', 'Delivery created successfully.');
    }

    public function productCodeExists($number){
        return Product::whereProductBarCode($number)->exists();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('marchant.pages.delivery-show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('marchant.pages.delivery-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $product->update($request->all());
        // return redirect('product')->withSuccess('Update successfully.');
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();
        // return redirect('product')->withSuccess('Delete successfully.');
        return response()->json(['status' => 'success']);
    }
}
