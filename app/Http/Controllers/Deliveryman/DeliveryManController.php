<?php

namespace App\Http\Controllers\Deliveryman;

use App\Http\Controllers\Controller;
use App\Mail\DeliverymanForgotPasswordMail;
use App\Mail\DeliverymanRegisterMail;
use App\Mail\SendCustomerMail;
use App\Models\Deliveryman;
use App\Models\Fraud;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DeliveryManController extends Controller
{
    public function index()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman-dashboard', compact('deliveryman'));
    }

    public function create()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman.auth.registration', compact('deliveryman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deliveryman_name' => 'required',
            'phone' => 'required',
            'alt_phone' => 'required',
            'email' => 'required|email|unique:deliverymen,email',
            'password' => 'required|min:8|confirmed',
            'full_address' => 'required',
            'police_station' => 'required',
            'district' => 'required',
            'division' => 'required',
            'nid_front' => 'required',
            'nid_back' => 'required',
            'profile_img' => 'required',
        ]);

        $deliveryman = new Deliveryman;
        $deliveryman->deliveryman_name = $request->deliveryman_name;
        $deliveryman->phone = $request->phone;
        $deliveryman->alt_phone = $request->alt_phone;
        $deliveryman->email = $request->email;
        $deliveryman->password = Hash::make($request->password);
        $deliveryman->full_address = $request->full_address;
        $deliveryman->police_station = $request->police_station;
        $deliveryman->district = $request->district;
        $deliveryman->division = $request->division;
        $deliveryman->verification_token = Str::random(40);

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $filename = $deliveryman->deliveryman_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('deliverymen/profile_images/', $filename);
            $deliveryman->profile_img = $filename;
        }

        if ($request->hasFile('nid_front')) {
            $file = $request->file('nid_front');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_front->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_front = $filename;
        }

        if ($request->hasFile('nid_back')) {
            $file = $request->file('nid_back');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_back->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_back = $filename;
        }

        $deliveryman->save();
        Mail::to($deliveryman->email)->send(new DeliverymanRegisterMail($deliveryman));

        return redirect('deliveryman/login')->withSuccess('Your Registration completed. Verify your email for login.');
    }

    public function verifyMail($token)
    {
        $deliveryman = Deliveryman::where('verification_token', '=', $token)->first();
        if (!empty($deliveryman)) {
            $deliveryman->email_verified_at = date('Y-m-d H:i:s');
            $deliveryman->mail_verified = 1;
            $deliveryman->verification_token = Str::random(40);
            $deliveryman->save();

            return redirect('deliveryman/login')->withSuccess('Your accounnt successfully verified.');
        } else {
            abort(404);
        }
    }

    public function loginView()
    {

        return view('deliveryman.auth.login');
    }

    function loginCheck(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $deliveryman = Deliveryman::where('email', '=', $request->email)->where('mail_verified', '=', 1)->where('is_active', '=', 2)->first();
        if ($deliveryman) {
            if (Hash::check($request->password, $deliveryman->password)) {
                $request->session()->put('loginId', $deliveryman->id);
                return redirect('deliveryman/dashboard');
            } else if ($request->password == $deliveryman->password) {
                $request->session()->put('loginId', $deliveryman->id);
                return redirect('deliveryman/dashboard');
            } else {

                return back()->with('fail', 'Login details are not valid');
            }
        } else {
            return back()->with('fail', 'Login details are not valid');
        }
    }

    function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('deliveryman/login');
        }
    }

    public function showForgotPasswordForm()
    {
        return view('deliveryman.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $deliveryman = Deliveryman::where('email', '=', $request->email)->first();
        if (!empty($deliveryman)) {
            $deliveryman->verification_token = Str::random(40);
            $deliveryman->save();

            Mail::to($deliveryman->email)->send(new DeliverymanForgotPasswordMail($deliveryman));

            return redirect()->back()->with('success', 'Please check your email and reset your password.');
        } else {
            return redirect()->back()->with('fail', 'Email not found.');
        }
    }

    public function resetPassword($token)
    {
        $deliveryman = Deliveryman::where('verification_token', '=', $token)->first();
        if (!empty($deliveryman)) {
            $data['deliveryman'] = $deliveryman;

            return view('deliveryman.auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postResetPassword($token, Request $request)
    {
        $deliveryman = Deliveryman::where('verification_token', '=', $token)->first();
        if (!empty($deliveryman)) {
            if ($request->password == $request->confirm_password) {
                $deliveryman->password = Hash::make($request->password);
                if (!empty($deliveryman->email_verified_at)) {
                    $deliveryman->email_verified_at = date('Y-m-d H:i:s');
                }
                $deliveryman->verification_token = Str::random(40);
                $deliveryman->save();

                return redirect('deliveryman/login')->with('success', 'Password reset successfully.');
            } else {
                return redirect()->back()->with('fail', 'Password and Confirm password does not match.');
            }
        } else {
            abort(404);
        }
    }

    public function edit(Request $request)
    {

        $id = Session::get('loginId');
        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        return view('deliveryman.auth.deliveryman-update', ['deliveryman' => $deliveryman]);
    }


    public function deliverymanUpdate(Request $request)
    {
        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->deliveryman_name = $request->deliveryman_name;
        $deliveryman->phone = $request->phone;
        $deliveryman->alt_phone = $request->alt_phone;
        $deliveryman->email = $request->email;
        $deliveryman->full_address = $request->full_address;
        $deliveryman->police_station = $request->police_station;
        $deliveryman->district = $request->district;
        $deliveryman->division = $request->division;
        if ($request->hasFile('profile_img')) {
            $destination = public_path('deliverymen/profile_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('profile_img');
            $filename = $deliveryman->deliveryman_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('deliverymen/profile_images/', $filename);
            $deliveryman->profile_img = $filename;
        }

        if ($request->hasFile('nid_front')) {
            $destination = public_path('deliverymen/nid_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('nid_front');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_front->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_front = $filename;
        }

        if ($request->hasFile('nid_back')) {
            $destination = public_path('deliverymen/nid_images/' . $deliveryman->deliveryman_name . '_' . $request->oldimage);
            // dd($destination);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('nid_back');
            $filename = $deliveryman->deliveryman_name . '_' . $request->nid_back->getClientOriginalName();
            $file->move('deliverymen/nid_images/', $filename);
            $deliveryman->nid_back = $filename;
        }

        $deliveryman->update();
        return redirect('deliveryman/edit')->withSuccess('Update successfully.');
    }

    function changePassword()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }

        return view('deliveryman.auth.deliveryman-change-password', compact('deliveryman'));
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        if (Hash::check($request->old_password, $deliveryman->password)) {
            $deliveryman->password = Hash::make($request->password);
            $deliveryman->update();

            return redirect('deliveryman/change/password')->withSuccess('Update successfully.');
        } else {

            return redirect('deliveryman/change/password')->withSuccess('Old Password Does not Match.');
        };
    }

    public function deliverymanDelete(Request $request)
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }

        return view('deliveryman.auth.deliveryman-account-delete', compact('deliveryman'));
    }

    public function deliverymanDeleteAccount(Request $request)
    {

        $request->validate([
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $deliveryman = Deliveryman::where('id', '=', $id)->first();
        if (Hash::check($request->password, $deliveryman->password)) {
            $deliveryman->delete();
            return redirect('deliveryman/register');
        } else {
            return redirect('deliveryman/delete')->withSuccess('Invalid Password.');
        };
    }

    public function productTable()
    {

        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        $id = $deliveryman->id;
        // dd($id);
        $products = Product::where('deliveryman_id', '=', $id)
            ->orWhere('is_active', '=', 3)
            // ->orWhere('is_active', '=', 4)
            // ->orWhere('is_active', '=', 5)
            // ->orWhere('is_active', '=', 6)
            // ->orWhere('is_active', '=', 7)
            // ->orWhere('is_active', '=', 8)
            ->paginate(10);

        return view('deliveryman.pages.product-table', compact('products', 'deliveryman'));
    }

    public function productDeliveryCheckout(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 4;

        $id = Session::get('loginId');
        $delivery->deliveryman_id = $id;

        $delivery->update();
        Mail::to($delivery->customer_email)->send(new SendCustomerMail($delivery));

        // return redirect('deliveryman/product/table');
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function productDeliveryDelivered(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 5;

        $id = Session::get('loginId');
        $delivery->deliveryman_id = $id;

        $delivery->update();

        // return redirect('deliveryman/product/table');
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function productDeliveryReturn(Request $request)
    {
        $delivery = Product::find($request->id);
        $delivery->is_active = 6;

        $id = Session::get('loginId');
        // dd($id);
        $delivery->deliveryman_id = $id;

        $delivery->update();
        return response()->json([
            'status' => 'success',
        ]);
        // return redirect('deliveryman/product/table');
    }
    public function productDeliveryCancel(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 7;

        $id = Session::get('loginId');
        // dd($id);
        $delivery->deliveryman_id = $id;

        $delivery->update();

        // return redirect('deliveryman/product/table');
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function searcDeliverymanProductTable(Request $request)
    {
        $search = $request->input('admin_delivery_search');

        $customers = Product::with(['user:id,merchant_name'])
            ->where(function ($query) use ($search) {
                $query->where('product_category', 'like', '%' . $search . '%')
                    ->orWhere('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('customer_phone', 'like', '%' . $search . '%')
                    ->orWhere('full_address', 'like', '%' . $search . '%')
                    ->orWhere('divisions', 'like', '%' . $search . '%')
                    ->orWhere('district', 'like', '%' . $search . '%')
                    ->orWhere('police_station', 'like', '%' . $search . '%')
                    ->orWhere('delivery_type', 'like', '%' . $search . '%')
                    ->orWhere('order_tracking_id', 'like', '%' . $search . '%')
                    ->orWhere('cod_amount', 'like', '%' . $search . '%')
                    ->orWhere('invoice', 'like', '%' . $search . '%');
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('merchant_name', 'like', '%' . $search . '%');
            })
            ->get();

        $tableHtml = '<table id="table" class="table table-light table-hover">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th>ID</th>';
        $tableHtml .= '<th>Merchant Name</th>';
        $tableHtml .= '<th>Customer Name</th>';
        $tableHtml .= '<th>Customer Phone</th>';
        $tableHtml .= '<th>Address</th>';
        $tableHtml .= '<th>Police Station</th>';
        $tableHtml .= '<th>District</th>';
        $tableHtml .= '<th>Division</th>';
        $tableHtml .= '<th>Product Category</th>';
        $tableHtml .= '<th>Delivery Type</th>';
        $tableHtml .= '<th>COD</th>';
        $tableHtml .= '<th>Order Tracking Id</th>';
        $tableHtml .= '<th>Invoice</th>';
        $tableHtml .= '<th>Note</th>';
        $tableHtml .= '<th>Exchange Status</th>';
        $tableHtml .= '<th>Delivery Charge</th>';
        $tableHtml .= '<th>	Status</th>';
        $tableHtml .= '<th>Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        // $tableHtml .= '<tbody>';
        // if (!$customers->isEmpty()) {
        //     foreach ($customers as $customer) {
        //         $tableHtml .= '<tr>';
        //         $tableHtml .= '<td>' . $customer->id . '</td>';
        //         $tableHtml .= '<td>' . $customer->user->merchant_name  . '</td>';
        //         $tableHtml .= '<td>' . $customer->customer_name . '</td>';
        //         $tableHtml .= '<td>' . $customer->customer_phone . '</td>';
        //         $tableHtml .= '<td>' . $customer->full_address . '</td>';
        //         $tableHtml .= '<td>' . $customer->police_station . '</td>';
        //         $tableHtml .= '<td>' . $customer->district . '</td>';
        //         $tableHtml .= '<td>' . $customer->divisions . '</td>';
        //         $tableHtml .= '<td>' . $customer->product_category . '</td>';
        //         $tableHtml .= '<td>' . $customer->delivery_type . '</td>';
        //         $tableHtml .= '<td>' . $customer->cod_amount . '</td>';
        //         $tableHtml .= '<td>' . $customer->order_tracking_id . '</td>';
        //         $tableHtml .= '<td>' . $customer->invoice . '</td>';
        //         $tableHtml .= '<td>' . $customer->note . '</td>';
        //         $tableHtml .= '<td>' . $customer->exchange_status . '</td>';
        //         $tableHtml .= '<td>' . $customer->delivery_charge . '</td>';
        //         $tableHtml .= '<td>' .
        //             ($customer->is_active == 1 ? '<span class="badge bg-label-danger me-1 text-dark">Product Pending</span>' : ($customer->is_active == 2 ? '<span class="badge bg-label-danger me-1 text-dark">Product On the way</span>' : ($customer->is_active == 3 ? '<span class="badge bg-label-danger me-1 text-dark">Product arrived <br> in the <br> warehouse</span>' : ($customer->is_active == 4 ? '<span class="badge bg-label-danger me-1 text-dark">Product picked <br> by delivery man</span>' : ($customer->is_active == 5 ? '<span class="badge bg-label-success me-1 text-dark">Product Delivered</span>' : ($customer->is_active == 6 ? '<span class="badge bg-label-success me-1 text-dark">Product Return</span>' : ($customer->is_active === '8' ? '<span class="badge bg-label-success me-1 text-dark">Product cancel <br> the Admin</span>' : ($customer->is_active == 7 ? '<span class="badge bg-label-success me-1 text-dark">Product canceled</span>' : '')))))))) . '</td>';
        //         $tableHtml .= '<td>';
        //         $tableHtml .= '<div class="d-flex justify-center align-items-center gap-2">';
        //         if ($customer->is_active == 1 || $customer->is_active == 2 || $customer->is_active === '8' || $customer->is_active == 5 || $customer->is_active == 6 || $customer->is_active == 7) {
        //             $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
        //         } elseif ($customer->is_active == 3) {
        //             $tableHtml .= '<form id="productcheckout" action="' . route('deliveryman.product.checkout') . '" method="post">';
        //             $tableHtml .= csrf_field();
        //             $tableHtml .= '<input type="hidden" name="id" value="' . $customer->id . '">';
        //             $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fa-solid fa-cart-shopping"></i></button>';
        //             $tableHtml .= '</form>';
        //         } elseif ($customer->is_active == 4) {
        //             $tableHtml .= '<form  id="deliverymanproductcheckout" action="' . route('deliveryman.product.delivered') . '" method="post">';
        //             $tableHtml .= csrf_field();
        //             $tableHtml .= '<input type="hidden" name="id" value="' . $customer->id . '">';
        //             $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fas fa-truck"></i></button>';
        //             $tableHtml .= '</form>';
        //             $tableHtml .= '<form id="deliverymanProductReturn" action="' . route('deliveryman.product.return') . '" method="post">';
        //             $tableHtml .= csrf_field();
        //             $tableHtml .= '<input type="hidden" name="id" value="' . $customer->id . '">';
        //             $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fa-solid fa-right-left"></i></button>';
        //             $tableHtml .= '</form>';
        //             $tableHtml .= '<form id="deliverymanProductCancel" action="' . route('deliveryman.product.cancel') . '" method="post">';
        //             $tableHtml .= csrf_field();
        //             $tableHtml .= '<input type="hidden" name="id" value="' . $customer->id . '">';
        //             $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-times"></i></button>';
        //             $tableHtml .= '</form>';
        //         }
        //         $tableHtml .= '</div>';
        //         $tableHtml .= '</td>';

        //         $tableHtml .= '</td>';
        //         $tableHtml .= '</tr>';
        //     }
        // } else {
        //     $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        // }
        // $tableHtml .= '</tbody>';


        $tableHtml .= '<tbody>';
        foreach ($customers as $delivery) {
            $tableHtml .= '<tr class="table-info">';
            $tableHtml .= '<td>' . $delivery->id . '</td>';
            $tableHtml .= '<td>';
            if ($delivery->user) {
                if ($delivery->user->merchant_name) {
                    $tableHtml .= $delivery->user->merchant_name;
                } elseif ($delivery->user->local_user_name) {
                    $tableHtml .= $delivery->user->local_user_name;
                } else {
                    $tableHtml .= $delivery->user->merchant_name;
                }
            } else {
                $tableHtml .= $delivery->local_user_name . ' (0' . $delivery->local_user_contact . ', ' . $delivery->local_user_address . ')';
            }
            $tableHtml .= '</td>';
            $tableHtml .= '<td>' . $delivery->customer_name . '</td>';
            $tableHtml .= '<td>' . $delivery->customer_phone . '</td>';
            $tableHtml .= '<td>' . $delivery->full_address . '</td>';
            $tableHtml .= '<td>' . $delivery->police_station . '</td>';
            $tableHtml .= '<td>' . $delivery->district . '</td>';
            $tableHtml .= '<td>' . $delivery->divisions . '</td>';
            $tableHtml .= '<td>' . $delivery->product_category . '</td>';
            $tableHtml .= '<td>' . $delivery->delivery_type . '</td>';
            $tableHtml .= '<td>' . $delivery->cod_amount . '</td>';
            $tableHtml .= '<td>' . $delivery->order_tracking_id . '</td>';
            $tableHtml .= '<td>' . $delivery->invoice . '</td>';
            $tableHtml .= '<td>' . $delivery->note . '</td>';
            $tableHtml .= '<td>' . $delivery->exchange_status . '</td>';
            $tableHtml .= '<td>' . $delivery->delivery_charge . '</td>';
            if ($delivery->is_active == 1) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Pending</span></td>';
            } elseif ($delivery->is_active == 2) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product On the way</span></td>';
            } elseif ($delivery->is_active == 3) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product arrived <br> in the <br> ware house</span></td>';
            } elseif ($delivery->is_active == 4) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product picked <br> by delivery man</span></td>';
            } elseif ($delivery->is_active == 5) {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Delivered</span></td>';
            } elseif ($delivery->is_active == 6) {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Return</span></td>';
            } elseif ($delivery->is_active === '8') {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Cancel <br> by the Admin</span></td>';
            } elseif ($delivery->is_active === '7') {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product canceled</span></td>';
            } elseif ($delivery->is_active === '9') {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">pickupman accept <br> for return</span></td>';
            } elseif ($delivery->is_active === '10') {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product rerun <br> successfully</span></td>';
            }
            $tableHtml .= '<td>';
            $tableHtml .= '<div class="d-flex justify-center align-items-center gap-2">';
            if ($delivery->is_active == 1 || $delivery->is_active == 2) {
                $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
            }
            if ($delivery->is_active == 3) {
                $tableHtml .= '<form id="productcheckout" action="' . route('deliveryman.product.checkout') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-success text-white" type="submit"><i class="fa-solid fa-cart-shopping"></i></button>';
                $tableHtml .= '</form>';
            }
            if ($delivery->is_active == 4) {
                $tableHtml .= '<form id="deliverymanproductcheckout" action="' . route('deliveryman.product.delivered') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fas fa-truck"></i></button>';
                $tableHtml .= '</form>';
                $tableHtml .= '<form id="deliverymanProductReturn" action="' . route('deliveryman.product.return') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fa-solid fa-right-left"></i></button>';
                $tableHtml .= '</form>';
                $tableHtml .= '<form id="deliverymanProductCancel" action="' . route('deliveryman.product.cancel') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-times"></i></button>';
                $tableHtml .= '</form>';
            }
            if ($delivery->is_active == 5 || $delivery->is_active == 6 || $delivery->is_active === '8' || $delivery->is_active == 7 || $delivery->is_active == 9 || $delivery->is_active == 10) {
                $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
            }
            $tableHtml .= '</div>';
            $tableHtml .= '</td>';
            $tableHtml .= '</tr>';
        }
        $tableHtml .= '</tbody>';

        $tableHtml .= '</table>';

        return $tableHtml;
        // return response()->json(['customers' => $customers]);
    }


    public function deliveryman_fraud_check()
    {
        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        $frauds = Fraud::all();
        $formattedFrauds = $frauds->map(function ($fraud) {
            $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
            return $fraud;
        });
        return view('deliveryman.pages.fraud_check', compact('deliveryman', 'formattedFrauds'));
    }
    public function deliveryman_fraud_add_new()
    {
        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman.pages.fraud_add_new', compact('deliveryman'));
    }
    public function deliveryman_fraud_add_new_insert(Request $request)
    {

        Validator::make($request->all(), [
            'phone_number' => 'required',
            'disputant_name' => 'required',
            'details' => 'required',
            'fast_move_parcel_id' => 'nullable',
            'deliveryman_id' => 'nullable',
        ]);
        $fraud = new Fraud();
        $fraud->phone_number = $request->phone_number;
        $fraud->disputant_name = $request->disputant_name;
        $fraud->details = $request->details;
        $fraud->fast_move_parcel_id = $request->steadfast_parcel_id;
        $fraud->deliveryman_id = $request->user_id;
        $fraud->save();
        return redirect()->back()->with('message', 'Fraud Added Successfully');
    }
    public function deliveryman_fraud_check_search()
    {
        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman.pages.fraud_check_search', compact('deliveryman'));
    }
    public function deliveryman_fraud_myentries()
    {
        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        $frauds = Fraud::where('deliveryman_id', $deliveryman->id)->get();
        $formattedFrauds = $frauds->map(function ($fraud) {
            $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
            return $fraud;
        });
        return view('deliveryman.pages.myentries', compact('deliveryman', 'formattedFrauds'));
    }
    public function deliveryman_fraud_search(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric|digits:11',
        ]);
        $phone_number = $request->input('phone_number');

        $result = Fraud::where('phone_number', '=', $phone_number)->get();
        return response()->json(['result' => $result]);
    }
    public function deliveryman_fraud_delete($id)
    {

        $fraud = Fraud::findOrFail($id);
        $fraud->delete();
        return redirect()->back()->with('message', 'Fraud record remove successfully');
    }
}
