<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    // public function index()
    // {
    //     try {
    //         if (Session::has('loginId')) {
    //             $admin = Admin::where('id', '=', Session::get('loginId'))->first();
    //         }
    //         $deliveries = Product::paginate(10);
    //         return view('server.pages.delivery-table', compact('deliveries', 'admin'));
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function edit(Request $request)
    // {
    //     try {
    //         if (Session::has('loginId')) {
    //             $admin = Admin::where('id', '=', Session::get('loginId'))->first();
    //         }
    //         $delivery = Product::find($request->id);
    //         return view('server.pages.admin-delivery-edit', compact('delivery', 'admin'));
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function update(Request $request)
    // {
    //     try {
    //         $delivery = Product::find($request->id);
    //         $delivery->product_category = $request->product_category;
    //         $delivery->customer_name = $request->customer_name;
    //         $delivery->customer_phone = $request->customer_phone;
    //         $delivery->full_address = $request->full_address;
    //         $delivery->divisions = $request->divisions;
    //         $delivery->district = $request->district;
    //         $delivery->police_station = $request->police_station;
    //         $delivery->delivery_type = $request->delivery_type;
    //         $delivery->cod_amount = $request->cod_amount;
    //         $delivery->invoice = $request->invoice;
    //         $delivery->note = $request->note;
    //         $delivery->product_weight = $request->product_weight;
    //         $delivery->exchange_status = $request->exchange_status;
    //         $delivery->delivery_charge = $request->delivery_charge;

    //         $delivery->update();
    //         return redirect('admin/delivery')->withSuccess('Update successfully.');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function deliveryConfirmation(Request $request)
    // {
    //     try {
    //         $delivery = Product::find($request->id);
    //         $delivery->is_active = 2;

    //         $delivery->update();

    //         return redirect('admin/delivery');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function deliveryCheckout(Request $request)
    // {
    //     try {
    //         $delivery = Product::find($request->id);
    //         $delivery->is_active = 3;

    //         $delivery->update();

    //         return redirect('admin/delivery');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function deliveryDelivered(Request $request)
    // {
    //     try {
    //         $delivery = Product::find($request->id);
    //         $delivery->is_active = 4;

    //         $delivery->update();

    //         return redirect('admin/delivery');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }


    // public function cancelConfirmation(Request $request)
    // {
    //     try {
    //         $delivery = Product::find($request->id);
    //         $delivery->is_active = 'cancelled';
    //         $delivery->update();
    //         return redirect('admin/delivery');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }

    // public function destroy(Request $request)
    // {
    //     try {
    //         Product::find($request->id)->delete();
    //         return redirect('admin/delivery');
    //     } catch (\Throwable $th) {
    //         return view('marchant.pages.404');
    //     }
    // }
}
