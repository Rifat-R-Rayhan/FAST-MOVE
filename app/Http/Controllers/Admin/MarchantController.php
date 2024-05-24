<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deliverycharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MarchantController extends Controller
{
    public function index()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $users = User::paginate(10);
        return view('server.pages.marchant-table', compact('users', 'admin'));
    }

    public function merchantExcelExport()
    {

        return Excel::download(new UserExport, 'merchants.xlsx');
    }


    public function percel_delivery_charge(Request $request)
    {
        $from_location = $request->input('from_location');
        $destination = $request->input('destination');
        // return $from_location;
        $product_weight = $request->input('product_weight');
        $delivery_type = $request->input('delivery_type');

        $query = DeliveryCharge::where([
            'from_location' => $from_location,
            'destination' => $destination,
        ]);
        if (!empty($delivery_type)) {
            $query->where('delivery_type', $delivery_type);
        }

        $deliveryCharge = $query->first();

        if ($deliveryCharge) {
            $finalPrice = $deliveryCharge->cost * $product_weight;

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
}
