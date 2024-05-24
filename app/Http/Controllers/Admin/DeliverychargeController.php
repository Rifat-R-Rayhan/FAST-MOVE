<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deliverycharge;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeliverychargeController extends Controller
{
    public function addDeliveryCharge()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.calculator-create', compact('admin'));
    }
    public function storeDeliveryCharge(Request $request)
    {

        Validator::make($request->all(), [
            'from_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'delivery_type' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        $deliveryCharge = new Deliverycharge();

        $deliveryCharge->from_location = $request->from_location;
        $deliveryCharge->destination = $request->destination;
        $deliveryCharge->category = $request->category;
        $deliveryCharge->delivery_type = $request->delivery_type;
        $deliveryCharge->cost = $request->cost;
        $deliveryCharge->save();
        return redirect()->back()->with('message', 'Delivery Charge Added Successfully');
    }


    // public function calculate_delivery_charge(Request $request)
    // {

    //     $fromLocation = $request->input('from_location');
    //     $destination = $request->input('destination');
    //     $service = $request->input('cost');
    //     $weight = $request->input('weight');

    //     $deliveryCharge = DeliveryCharge::where([
    //         'from_location' => $fromLocation,
    //         'destination' => $destination,
    //     ])->first();

    //     if ($deliveryCharge) {
    //         $finalPrice = $service === '1' ? $deliveryCharge->regular : $deliveryCharge->same_day;
    //         $finalPrice *= $weight;

    //         return response()->json([
    //             'deliveryCharge' => [
    //                 'cost' => $finalPrice,
    //             ]
    //         ]);
    //     } else {
    //         return response()->json([
    //             'error' => 'Invalid delivery charge',
    //         ], 400);
    //     }
    // }

    public function calculate_delivery_charge(Request $request)
    {
        $fromLocation = $request->input('from_location');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $service = $request->input('service');

        $query = DeliveryCharge::where([
            'from_location' => $fromLocation,
            'destination' => $destination,
        ]);

        if (!empty($service)) {
            $query->where('delivery_type', $service);
        }

        $deliveryCharge = $query->first();

        if ($deliveryCharge) {
            $finalPrice = $deliveryCharge->cost * $weight;
            return response()->json([
                'deliveryCharge' => [
                    'cost' => $finalPrice,
                ]
            ]);
        } else {
            return response()->json([
                'error' => 'Invalid delivery charge',
            ], 400);
        }
    }

    public function search(Request $request)
    {

        $trackingId = $request->input('tracking_id');
        $delivery = Product::where('order_tracking_id', $trackingId)->first();
        return response()->json(['delivery' => $delivery]);
    }
}
