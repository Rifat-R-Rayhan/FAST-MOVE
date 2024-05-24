<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MarchantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        $id = Auth::user()->id;
        $marchant = User::where('id', '=', $id)->get();
        // $marchant = User::all();

        return view('marchant-dashboard', compact('marchant'));
    }

    public function productCreate()
    {
        $id = Auth::id();
        $uuid = Uuid::uuid4()->toString();
        $uuid = str_replace("-", "", $uuid);
        $firstFiveChars = substr($uuid, 0, 5);
        $numericValue = hexdec($firstFiveChars);
        return view('marchant.pages.delivery-create', compact('id', 'numericValue'));
    }


    public function searchme(Request $request)
    {
        $userId = Auth::id();
        $searchTerm = $request->input('admin_delivery_search');
        $deliveries = Product::where('user_id', $userId)
            ->where(function ($query) use ($searchTerm) {
                $query->where('delivery_type', 'LIKE', "%$searchTerm%")
                    ->orWhere('customer_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('customer_phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('full_address', 'LIKE', "%$searchTerm%")
                    ->orWhere('product_category', 'LIKE', "%$searchTerm%")
                    ->orWhere('district', 'LIKE', "%$searchTerm%")
                    ->orWhere('order_tracking_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('divisions', 'LIKE', "%$searchTerm%");
            })
            ->get();
        $tableHtml = '<div class="table-responsive">';
        $tableHtml .= '<table class="table table-bordered" id="table">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Customer Name</th>';
        $tableHtml .= '<th scope="col">Customer Phone</th>';
        $tableHtml .= '<th scope="col">Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Product Category</th>';
        $tableHtml .= '<th scope="col">Delivery Type</th>';
        $tableHtml .= '<th scope="col">Tracking Id</th>';
        $tableHtml .= '<th scope="col">Invoice</th>';
        $tableHtml .= '<th scope="col">Note</th>';
        $tableHtml .= '<th scope="col">Exchange Status</th>';
        $tableHtml .= '<th scope="col">Delivery Charge</th>';
        $tableHtml .= '<th scope="col">Product Price</th>';
        $tableHtml .= '<th scope="col">Product weight</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        if (!$deliveries->isEmpty()) {
            foreach ($deliveries as $delivery) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $delivery->id . '</td>';
                $tableHtml .= '<td>' . $delivery->customer_name . '</td>';
                $tableHtml .= '<td>' . $delivery->customer_phone . '</td>';
                $tableHtml .= '<td>' . $delivery->full_address . '</td>';
                $tableHtml .= '<td>' . $delivery->police_station . '</td>';
                $tableHtml .= '<td>' . $delivery->district . '</td>';
                $tableHtml .= '<td>' . $delivery->divisions . '</td>';
                $tableHtml .= '<td>' . $delivery->product_category . '</td>';
                $tableHtml .= '<td>' . $delivery->delivery_type . '</td>';
                $tableHtml .= '<td>' . $delivery->order_tracking_id . '</td>';
                $tableHtml .= '<td>' . $delivery->invoice . '</td>';
                $tableHtml .= '<td>' . $delivery->note . '</td>';
                $tableHtml .= '<td>' . $delivery->exchange_status . '</td>';
                $tableHtml .= '<td>' . $delivery->delivery_charge . '</td>';
                $tableHtml .= '<td>' . $delivery->cod_amount . '</td>';
                $tableHtml .= '<td>' . $delivery->product_weight . '</td>';

                if ($delivery->is_active === '1') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Awaiting response <br> for Pickupman</span></td>';
                } elseif ($delivery->is_active === '2') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product On <br> the way</span></td>';
                } elseif ($delivery->is_active === '3') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Stocked</span></td>';
                } elseif ($delivery->is_active === '4') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>';
                } elseif ($delivery->is_active === '5') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Delivered</span></td>';
                } elseif ($delivery->is_active === '6') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Return and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == 7) {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == '8') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> by the admin and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == '9') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Returned product <br> pickupman accepted <br>and on the way</span></td>';
                } elseif ($delivery->is_active == '10') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Returned product <br> merchant accepted <br>successfully</span></td>';
                }

                if ($delivery->is_active === '8') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark"><br> No action <br> available</span></td>';
                } elseif ($delivery->is_active === '9') {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-center align-items-center gap-2">';
                    $tableHtml .= '<form id="merchantReturnProductAcceptCoformation" action="' . route('marchant.accept_product_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-success text-white" type="submit">';
                    $tableHtml .= '<i class="fa-solid fa-check"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                } elseif ($delivery->is_active === '1') {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                    $tableHtml .= '<button class="btn btn-sm btn-success showMerchantProductButton" data-bs-toggle="modal" data-bs-target="#showMerchantproductModal" data-id="' . $delivery->id . '" data-customer_name="' . $delivery->customer_name . '" data-customer_phone="' . $delivery->customer_phone . '" data-full_address="' . $delivery->full_address . '" data-police_station="' . $delivery->police_station . '" data-district="' . $delivery->district . '" data-divisions="' . $delivery->divisions . '" data-product_category="' . $delivery->product_category . '" data-delivery_type="' . $delivery->delivery_type . '" data-amount="' . $delivery->cod_amount . '" data-status="' . $delivery->is_active . '" data-order_tracking_id="' . $delivery->order_tracking_id . '" data-invoice="' . $delivery->invoice . '" data-note="' . $delivery->note . '" data-weight="' . $delivery->product_weight . '" data-exchange_status="' . $delivery->exchange_status . '" data-delivery_charge="' . $delivery->delivery_charge . '" id="showProductMerchantForm">';
                    $tableHtml .= '<i class="fas fa-eye"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '<button class="btn btn-sm btn-success merchantProductEditModal" data-bs-toggle="modal" data-bs-target="#merchantProductEditModal" data-idtoedit="' . $delivery->id . '" data-customer_nametoedit="' . $delivery->customer_name . '" data-customer_phonetoedit="' . $delivery->customer_phone . '" data-full_addresstoedit="' . $delivery->full_address . '" data-police_stationtoedit="' . $delivery->police_station . '" data-districttoedit="' . $delivery->district . '" data-divisionstoedit="' . $delivery->divisions . '" data-product_categorytoedit="' . $delivery->product_category . '" data-delivery_typetoedit="' . $delivery->delivery_type . '" data-amounttoedit="' . $delivery->cod_amount . '" data-statustoedit="' . $delivery->is_active . '" data-order_tracking_idtoedit="' . $delivery->order_tracking_id . '" data-invoicetoedit="' . $delivery->invoice . '" data-notetoedit="' . $delivery->note . '" data-exchange_statustoedit="' . $delivery->exchange_status . '" data-delivery_chargetoedit="' . $delivery->delivery_charge . '" data-weighttoedit="' . $delivery->product_weight . '" id="updateDeliveryForm">';
                    $tableHtml .= '<i class="fas fa-pencil-alt"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '<form id="merchantProductDeleteConformation" action="' . route('product.destroy', $delivery->id) . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= method_field('DELETE');
                    $tableHtml .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">';
                    $tableHtml .= '<i class="fas fa-trash-alt"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                } else {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                    $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">You have <br> No Action <br> Available</span>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                }

                $tableHtml .= '</tr>';
            }

            $tableHtml .= '</tbody>';
            $tableHtml .= '</table>';
            $tableHtml .= '</div>';
            return $tableHtml;
        }
    }


    public function optionsearch(Request $request)
    {
        $division = $request->input('division');
        $district = $request->input('district');
        $policeStation = $request->input('police_station');

        $query = Product::query();
        $userId = Auth::id();
        $query->where('user_id', $userId);

        if ($division) {
            $query->where('divisions', $division);
        }

        if ($district) {
            $query->where('district', $district);
        }

        if ($policeStation) {
            $query->where('police_station', $policeStation);
        }

        $deliveries = $query->get();
        $tableHtml = '<div class="table-responsive">';
        $tableHtml .= '<table class="table table-bordered" id="table">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Customer Name</th>';
        $tableHtml .= '<th scope="col">Customer Phone</th>';
        $tableHtml .= '<th scope="col">Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Product Category</th>';
        $tableHtml .= '<th scope="col">Delivery Type</th>';
        $tableHtml .= '<th scope="col">Tracking Id</th>';
        $tableHtml .= '<th scope="col">Invoice</th>';
        $tableHtml .= '<th scope="col">Note</th>';
        $tableHtml .= '<th scope="col">Exchange Status</th>';
        $tableHtml .= '<th scope="col">Delivery Charge</th>';
        $tableHtml .= '<th scope="col">Product Price</th>';
        $tableHtml .= '<th scope="col">Product weight</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        if (!$deliveries->isEmpty()) {
            foreach ($deliveries as $delivery) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $delivery->id . '</td>';
                $tableHtml .= '<td>' . $delivery->customer_name . '</td>';
                $tableHtml .= '<td>' . $delivery->customer_phone . '</td>';
                $tableHtml .= '<td>' . $delivery->full_address . '</td>';
                $tableHtml .= '<td>' . $delivery->police_station . '</td>';
                $tableHtml .= '<td>' . $delivery->district . '</td>';
                $tableHtml .= '<td>' . $delivery->divisions . '</td>';
                $tableHtml .= '<td>' . $delivery->product_category . '</td>';
                $tableHtml .= '<td>' . $delivery->delivery_type . '</td>';
                $tableHtml .= '<td>' . $delivery->order_tracking_id . '</td>';
                $tableHtml .= '<td>' . $delivery->invoice . '</td>';
                $tableHtml .= '<td>' . $delivery->note . '</td>';
                $tableHtml .= '<td>' . $delivery->exchange_status . '</td>';
                $tableHtml .= '<td>' . $delivery->delivery_charge . '</td>';
                $tableHtml .= '<td>' . $delivery->cod_amount . '</td>';
                $tableHtml .= '<td>' . $delivery->product_weight . '</td>';

                if ($delivery->is_active === '1') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Awaiting response <br> for Pickupman</span></td>';
                } elseif ($delivery->is_active === '2') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product On <br> the way</span></td>';
                } elseif ($delivery->is_active === '3') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Stocked</span></td>';
                } elseif ($delivery->is_active === '4') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>';
                } elseif ($delivery->is_active === '5') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Delivered</span></td>';
                } elseif ($delivery->is_active === '6') {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Return and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == 7) {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == '8') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> by the admin and <br> now it\'s in the <br> ware house</span></td>';
                } elseif ($delivery->is_active == '9') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Returned product <br> pickupman accepted <br>and on the way</span></td>';
                } elseif ($delivery->is_active == '10') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Returned product <br> merchant accepted <br>successfully</span></td>';
                }

                if ($delivery->is_active === '8') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark"><br> No action <br> available</span></td>';
                } elseif ($delivery->is_active === '9') {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-center align-items-center gap-2">';
                    $tableHtml .= '<form id="merchantReturnProductAcceptCoformation" action="' . route('marchant.accept_product_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-success text-white" type="submit">';
                    $tableHtml .= '<i class="fa-solid fa-check"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                } elseif ($delivery->is_active === '1') {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                    $tableHtml .= '<button class="btn btn-sm btn-success showMerchantProductButton" data-bs-toggle="modal" data-bs-target="#showMerchantproductModal" data-id="' . $delivery->id . '" data-customer_name="' . $delivery->customer_name . '" data-customer_phone="' . $delivery->customer_phone . '" data-full_address="' . $delivery->full_address . '" data-police_station="' . $delivery->police_station . '" data-district="' . $delivery->district . '" data-divisions="' . $delivery->divisions . '" data-product_category="' . $delivery->product_category . '" data-delivery_type="' . $delivery->delivery_type . '" data-amount="' . $delivery->cod_amount . '" data-status="' . $delivery->is_active . '" data-order_tracking_id="' . $delivery->order_tracking_id . '" data-invoice="' . $delivery->invoice . '" data-note="' . $delivery->note . '" data-weight="' . $delivery->product_weight . '" data-exchange_status="' . $delivery->exchange_status . '" data-delivery_charge="' . $delivery->delivery_charge . '" id="showProductMerchantForm">';
                    $tableHtml .= '<i class="fas fa-eye"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '<button class="btn btn-sm btn-success merchantProductEditModal" data-bs-toggle="modal" data-bs-target="#merchantProductEditModal" data-idtoedit="' . $delivery->id . '" data-customer_nametoedit="' . $delivery->customer_name . '" data-customer_phonetoedit="' . $delivery->customer_phone . '" data-full_addresstoedit="' . $delivery->full_address . '" data-police_stationtoedit="' . $delivery->police_station . '" data-districttoedit="' . $delivery->district . '" data-divisionstoedit="' . $delivery->divisions . '" data-product_categorytoedit="' . $delivery->product_category . '" data-delivery_typetoedit="' . $delivery->delivery_type . '" data-amounttoedit="' . $delivery->cod_amount . '" data-statustoedit="' . $delivery->is_active . '" data-order_tracking_idtoedit="' . $delivery->order_tracking_id . '" data-invoicetoedit="' . $delivery->invoice . '" data-notetoedit="' . $delivery->note . '" data-exchange_statustoedit="' . $delivery->exchange_status . '" data-delivery_chargetoedit="' . $delivery->delivery_charge . '" data-weighttoedit="' . $delivery->product_weight . '" id="updateDeliveryForm">';
                    $tableHtml .= '<i class="fas fa-pencil-alt"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '<form id="merchantProductDeleteConformation" action="' . route('product.destroy', $delivery->id) . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= method_field('DELETE');
                    $tableHtml .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">';
                    $tableHtml .= '<i class="fas fa-trash-alt"></i>';
                    $tableHtml .= '</button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                } else {
                    $tableHtml .= '<td>';
                    $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                    $tableHtml .= '<span class="badge bg-label-danger me-1 text-dark">You have <br> No Action <br> Available</span>';
                    $tableHtml .= '</div>';
                    $tableHtml .= '</td>';
                }

                $tableHtml .= '</tr>';
            }

            $tableHtml .= '</tbody>';
            $tableHtml .= '</table>';
            $tableHtml .= '</div>';
            return $tableHtml;
        }
    }

    public function merchantSaleReport()
    {
        $id = Auth::user()->id;
        $marchant = User::where('id', '=', $id)->get();
        return view('marchant.pages.merchant_sales_report', compact('marchant'));
    }

    public function coverageArea()
    {

        $id = Auth::user()->id;
        $marchant = User::where('id', '=', $id)->get();
        $area = Deliverycharge::all();
        return view('marchant.pages.coverage-area',  compact('area', 'marchant'));
    }
}
