<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Deliveryman;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AllConsignmentController extends Controller
{
        public function all_consignment()
        {
                // $user_id=Auth::id();
                // $allConsignment = Product::all();
                $user_id = Auth::id();
                $allConsignment = Product::where('user_id', $user_id)->get();
                return view('marchant.pages.all_consignment', compact('allConsignment'));
        }
        public function list_byDate()
        {
                
                $result = Product::selectRaw('date(created_at) as date, count(*) as total_products')
                        ->groupBy('date')
                        ->get();
                return view('marchant.pages.list_by_date_allConsignment', compact('result'));
        }
        public function pending_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                ->where('is_active', 2)->get();
                return view('marchant.pages.pending_consignment', compact('activeData'));
        }
        public function approval_pending_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                        ->where('is_active', 1)->get();
                return view('marchant.pages.approval_pending_consignment', compact('activeData'));
        }
        public function delivery_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                        ->where('is_active', 5)->get();
                return view('marchant.pages.delivered_consignment', compact('activeData'));
        }
        public function partly_delivery_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                ->where('is_active', 3)->get();
                return view('marchant.pages.partly_delivered', compact('activeData'));
        }
        public function cancel_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                        ->where('is_active', 7)->get();
                return view('marchant.pages.cancel_consignment', compact('activeData'));
        }
        public function inreview_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                        ->where('is_active', 6)->get();
                return view('marchant.pages.inreview_consignment', compact('activeData'));
        }
        public function latest_entries_consignment()
        {

                $today = Carbon::today();
                $tomorrow = Carbon::tomorrow();
                $formattedToday = $today->toDateString();
                $formattedTomorrow = $tomorrow->toDateString();
                $activeData = Product::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->get();
                $total = Product::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->count();
                $cod_amount = Product::whereBetween('created_at', [$formattedToday, $formattedTomorrow])->sum('cod_amount');
                return view('marchant.pages.latest_entries', compact('activeData', 'total', 'cod_amount'));
        }
        public function pick_n_drop_consignment()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                ->where('is_active', 4)->get();
                return view('marchant.pages.pick_n_drop_consignment', compact('activeData'));
        }
        public function stock()
        {
                $user_id = Auth::id();
                $activeData = Product::where('user_id', $user_id)
                                        ->where('is_active', 3)->get();
                return view('marchant.pages.stock_consigment', compact('activeData'));
        }
}
