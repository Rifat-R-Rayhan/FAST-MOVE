<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function dailySalesReport(Request $request)
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = Product::where('is_active', '=', 5);
    
        if ($startDate && $endDate) {
            $query->whereDate('updated_at', '>=', $startDate)
                  ->whereDate('updated_at', '<=', $endDate);
        }
    
        $products = $query->paginate(10);
    
        if (!$products) {
            return redirect()->back()->with('fail', 'Product not found.');
        }
    
        return view('server.pages.daily_sales_report', compact('products', 'admin'));
    }
    


    public function dailyTotalSalesReport(Request $request)
    {
        $admin = [];
        if (Session::has('loginId')) {
            $admin = Admin::find(Session::get('loginId'));
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $products = Product::selectRaw('DATE(updated_at) AS return_date,
                                       COUNT(*) AS total_parcel_count,
                                       SUM(CASE WHEN is_active = 5 THEN 1 ELSE 0 END) AS delivered_parcel_count,
                                       SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) AS pending_parcel_count,
                                       SUM(CASE WHEN is_active = 6 THEN 1 ELSE 0 END) AS returned_parcel_count')
                           ->groupBy(DB::raw('DATE(updated_at)'))
                           ->orderByRaw('return_date DESC');

                        if ($startDate && $endDate) {
                            $products->whereDate('updated_at', '>=', $startDate)
                                  ->whereDate('updated_at', '<=', $endDate);
                        }
        $products = $products->paginate(10);
        return view('server.pages.daily_total_sales_report', compact('products', 'admin'));
    }

    public function returnSalesReport(Request $request)
    {
        $admin = [];
        if (Session::has('loginId')) {
            $admin = Admin::find(Session::get('loginId'));
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $products = Product::selectRaw('DATE(products.updated_at) AS return_date,
                                        products.id AS order_id,
                                        products.customer_name,
                                        users.merchant_name AS merchant_name,
                                        deliverymen.deliveryman_name AS deliveryman_name,
                                        products.cod_amount AS amount')
                            ->leftJoin('users', 'products.user_id', '=', 'users.id')
                            ->leftJoin('deliverymen', 'products.deliveryman_id', '=', 'deliverymen.id')
                            ->where('products.is_active', 6);

                            if ($startDate && $endDate) {
                                $products->whereDate('products.updated_at', '>=', $startDate)
                                        ->whereDate('products.updated_at', '<=', $endDate);
                            }
            $products = $products->paginate(10);
        return view('server.pages.return_sales_report', compact('products', 'admin'));
    }

    public function merchantSalesReport(Request $request)
    {
        $admin = [];
        if (Session::has('loginId')) {
            $admin = Admin::find(Session::get('loginId'));
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $products = Product::selectRaw('DATE(products.updated_at) AS return_date,
                                        products.id AS order_id,
                                        products.customer_name,
                                        products.full_address,
                                        users.merchant_name AS merchant_name,
                                        deliverymen.deliveryman_name AS deliveryman_name,
                                        products.delivery_charge AS delivery_charge,
                                        products.cod_amount AS amount')
                            ->leftJoin('users', 'products.user_id', '=', 'users.id')
                            ->leftJoin('deliverymen', 'products.deliveryman_id', '=', 'deliverymen.id')
                            ->where('products.is_active', 5);

                            if ($startDate && $endDate) {
                                $products->whereDate('products.updated_at', '>=', $startDate)
                                    ->whereDate('products.updated_at', '<=', $endDate);
                            }
            $products = $products->paginate(10);

        return view('server.pages.merchant_sales_report', compact('products', 'admin'));
    }
}
