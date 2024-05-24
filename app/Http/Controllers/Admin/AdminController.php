<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminExport;
use App\Exports\DeliverymanExport;
use App\Exports\PickupmaExport;
use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\AdminImport;
use App\Imports\DeliverymanImport;
use App\Imports\PickupmanImport;
use App\Imports\ProductImport;
use App\Mail\AdminForgotPasswordMail;
use App\Models\Admin;
use App\Models\Deliverycharge;
use App\Models\Deliveryman;
use App\Models\Fraud;
use App\Models\Newsletter;
use App\Models\Pickupman;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('admin-dashboard', compact('admin'));
    }

    public function create()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.auth.admin-registration', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_name' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
            'role' => 'required',
            'profile_img' => 'required',
        ]);

        $admin = new Admin;
        $admin->admin_name = $request->admin_name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->address = $request->address;
        $admin->role = $request->role;

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $filename = $admin->admin_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('admins/profile_images/', $filename);
            $admin->profile_img = $filename;
        }

        $admin->save();
        // Admin::create($request->all());
        return redirect()->back()->withSuccess('Admin added successfully.');
    }

    public function loginView()
    {

        return view('server.auth.admin-login');
    }

    function loginCheck(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', '=', $request->email)->where('role', '=', $request->role)->first();

        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('loginId', $admin->id);
                // Log::channel('adminlogininfo')->info("User {id} successfully login.", ['id' => $admin->id]);
                return redirect('admin/dashboard');
            } else if ($request->password == $admin->password) {
                $request->session()->put('loginId', $admin->id);
                // Log::channel('adminlogininfo')->info("User {id} successfully login.", ['id' => $admin->id]);
                return redirect('admin/dashboard');
            } else {

                return back()->with('fail', 'Login details are not valid');
            }
        } else {
            return back()->with('fail', 'Login details are not valid');
        }
    }

    public function showForgotPasswordForm()
    {
        return view('server.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $admin = Admin::where('email', '=', $request->email)->first();
        if (!empty($admin)) {
            $admin->verification_token = Str::random(40);
            $admin->save();

            Mail::to($admin->email)->send(new AdminForgotPasswordMail($admin));

            return redirect()->back()->with('success', 'Please check your email and reset your password.');
        } else {
            return redirect()->back()->with('fail', 'Email not found.');
        }
    }

    public function resetPassword($token)
    {
        $admin = Admin::where('verification_token', '=', $token)->first();
        if (!empty($admin)) {
            $data['admin'] = $admin;

            return view('server.auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postResetPassword($token, Request $request)
    {
        $admin = Admin::where('verification_token', '=', $token)->first();
        if (!empty($admin)) {
            if ($request->password == $request->confirm_password) {
                $admin->password = Hash::make($request->password);
                if (!empty($admin->email_verified_at)) {
                    $admin->email_verified_at = date('Y-m-d H:i:s');
                }
                $admin->verification_token = Str::random(40);
                $admin->save();

                return redirect('admin/login')->with('success', 'Password reset successfully.');
            } else {
                return redirect()->back()->with('fail', 'Password and Confirm password does not match.');
            }
        } else {
            abort(404);
        }
    }


    public function tableAdmin()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $admins = Admin::paginate(10);
        return view('server.pages.admin-table',  compact('admins', 'admin'));
    }

    function logout()
    {

        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('admin/login');
        }
    }

    public function adminEdit(Request $request)
    {

        $id = Session::get('loginId');
        $admin = Admin::where('id', '=', $id)->first();
        // $admin = Admin::find($admin_id)->get(); 
        // dd($admin);
        return view('server.auth.admin-update', ['admin' => $admin]);
    }


    public function adminUpdate(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->admin_name = $request->admin_name;
        $admin->designation = $request->designation;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->address = $request->address;
        $admin->role = $request->role;
        if ($request->hasFile('profile_img')) {
            $destination = public_path('admins/profile_images/' . $admin->admin_name . '_' . $request->oldimage);
            if (file_exists($destination)) {
                unlink($destination);
            }
            $file = $request->file('profile_img');
            $filename = $admin->admin_name . '_' . $request->profile_img->getClientOriginalName();
            $file->move('admins/profile_images/', $filename);
            $admin->profile_img = $filename;
        }

        $admin->update();
        return redirect('admin/edit')->withSuccess('Admin update successfully.');
    }

    function changePassword()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        return view('server.auth.admin-change-password', compact('admin'));
    }

    function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $admin = Admin::where('id', '=', $id)->first();
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = Hash::make($request->password);
            $admin->update();

            return redirect('admin/change/password')->withSuccess('Update successfully.');
        } else {

            return redirect('admin/change/password')->withSuccess('Old Password Does not Match.');
        };
    }

    public function adminDelete(Request $request)
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        return view('server.auth.admin-account-delete', compact('admin'));
    }

    public function adminDeleteAccount(Request $request)
    {

        $request->validate([
            'password' => 'required',

        ]);

        $id = Session::get('loginId');

        $admin = Admin::where('id', '=', $id)->first();
        if (Hash::check($request->password, $admin->password)) {
            $admin->delete();
            return redirect('admin/register');
        } else {
            return redirect('admin/delete')->withSuccess('Invalid Password.');
        };
    }

    public function adminDestroy(Request $request)
    {
        Admin::find($request->id)->delete();
        return redirect('admin/table')->withSuccess('Admin Deleted');
    }

    public function searchAdmin(Request $request)
    {

        $search = $request->input('admin_delivery_search');

        $customers = Product::with(['pickupman:id,pickupman_name', 'deliveryman:id,deliveryman_name', 'user:id,merchant_name'])
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
            ->orWhereHas('pickupman', function ($query) use ($search) {
                $query->where('pickupman_name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('deliveryman', function ($query) use ($search) {
                $query->where('deliveryman_name', 'like', '%' . $search . '%');
            })
            ->get();
        $tableHtml = '<div class="table-responsive bg-light" id="tableContainer">';
        $tableHtml .= '<table class="table table-light table-hover" id="tableData">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Merchant Name</th>';
        $tableHtml .= '<th scope="col">Pickupman Name</th>';
        $tableHtml .= '<th scope="col">Deliveryman Name</th>';
        $tableHtml .= '<th scope="col">Customer Name</th>';
        $tableHtml .= '<th scope="col">Customer Phone</th>';
        $tableHtml .= '<th scope="col">Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Product Category</th>';
        $tableHtml .= '<th scope="col">Delivery Type</th>';
        $tableHtml .= '<th scope="col">COD</th>';
        $tableHtml .= '<th scope="col">Order Tracking Id</th>';
        $tableHtml .= '<th scope="col">Invoice</th>';
        $tableHtml .= '<th scope="col">Note</th>';
        $tableHtml .= '<th scope="col">Exchange Status</th>';
        $tableHtml .= '<th scope="col">Delivery Charge</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '<th scope="col">Update</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody id="container">';
        if (!$customers->isEmpty()) {
            foreach ($customers as $delivery) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $delivery->id . '</td>';
                $tableHtml .= '<td>' . $delivery->user->merchant_name . '</td>';
                // Check if pickupman is assigned
                if ($delivery->pickupman_id > 0) {
                    $tableHtml .= '<td>' . $delivery->pickupman->pickupman_name . '</td>';
                } else {
                    $tableHtml .= '<td>No one pickup</td>';
                }
                // Check if deliveryman is assigned
                if ($delivery->deliveryman_id > 0) {
                    $tableHtml .= '<td>' . $delivery->deliveryman->deliveryman_name . '</td>';
                } else {
                    $tableHtml .= '<td>No one delivered</td>';
                }
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
                // Display status based on is_active value
                if ($delivery->is_active == 2) {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product On the way</span></td>';
                } elseif ($delivery->is_active == 3) {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Stock</span></td>';
                } elseif ($delivery->is_active == 4) {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-dark">Product Shiped</span></td>';
                } elseif ($delivery->is_active == 5) {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Delivered</span></td>';
                } elseif ($delivery->is_active == 6) {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Return</span></td>';
                } elseif ($delivery->is_active == 8) {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br>and waiting for <br> pickupman for <br> return product to <br> the
                    merchant</span></td>';
                } elseif ($delivery->is_active === '7') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> By
                    Admin <br>and waiting for <br> pickupman for <br> return product to <br> the
                    merchant</span></td>';
                } elseif ($delivery->is_active === '9') {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">return product <br> on the
                    <br> way</span>';
                } elseif ($delivery->is_active === '10') {
                    $tableHtml .= '<td>product <br> return <br> successfully</td>';
                } else {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-dark">Product Pickupman <br> has not <br> reached yet</span></td>';
                }
                $tableHtml .= '<td>';
                if ($delivery->is_active == 2) {
                    // If product is on the way, show confirmation and cancellation buttons
                    $tableHtml .= '<div class="d-flex justify-center align-items-center gap-2">';
                    $tableHtml .= '<form id="deliveryConfirmationForm" action="' . route('admin.product.delivery_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-success text-white" type="submit"><i class="fa-solid fa-check"></i></button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '<form id="deliveryCancelConfirmationForm" action="' . route('admin.product.cancel_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-times"></i></button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '</div>';
                } elseif ($delivery->is_active == 'cancelled') {
                    $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Product Cancelled <br> By Admin</span>';
                } elseif ($delivery->is_active == 4 || $delivery->is_active == 5) {
                    $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                } elseif ($delivery->is_active == 3) {
                    $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">Awaiting response <br> for deliveryman</span>';
                } else {
                    $tableHtml .= '<span class="badge bg-label-success me-1 text-dark">You have no action</span>';
                }
                $tableHtml .= '</td>';

                $tableHtml .= '<td>';
                if ($delivery->is_active == 3 || $delivery->is_active == 8) {
                    $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                    $tableHtml .= '<button class="btn btn-sm btn-success updateDeliveryForm" data-bs-toggle="modal" data-bs-target="#updateModal"';
                    $tableHtml .= ' data-id="' . $delivery->id . '"';
                    $tableHtml .= ' data-name="' . $delivery->customer_name . '"';
                    $tableHtml .= ' data-phone="' . $delivery->customer_phone . '"';
                    $tableHtml .= ' data-address="' . $delivery->full_address . '"';
                    $tableHtml .= ' data-division="' . $delivery->divisions . '"';
                    $tableHtml .= ' data-dis="' . $delivery->district . '"';
                    $tableHtml .= ' data-police="' . $delivery->police_station . '"';
                    $tableHtml .= ' data-deliveryproduct="' . $delivery->product_category . '"';
                    $tableHtml .= ' data-del="' . $delivery->delivery_type . '"';
                    $tableHtml .= ' data-cod="' . $delivery->cod_amount . '"';
                    $tableHtml .= ' data-invoice="' . $delivery->invoice . '"';
                    $tableHtml .= ' data-note="' . $delivery->note . '"';
                    $tableHtml .= ' data-exchangeparcel="' . $delivery->exchange_status . '"';
                    $tableHtml .= ' data-weight="' . $delivery->product_weight . '"';
                    $tableHtml .= ' data-ordertrack="' . $delivery->order_tracking_id . '"';
                    $tableHtml .= ' data-deliverycharge="' . $delivery->delivery_charge . '"';
                    $tableHtml .= ' data-is_active="' . $delivery->is_active . '"><i class="fas fa-pencil-alt"></i></button>';
                    $tableHtml .= '<form id="productDeleteConformation" action="' . route('admin.product.delivery.delete') . '" method="get">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $delivery->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm(\'Are you sure?\')"><i class="fa-solid fa-trash-can"></i></button>';
                    $tableHtml .= '</form>';


                    $tableHtml .= '<button class="btn btn-sm btn-success showButton" data-bs-toggle="modal" data-bs-target="#showModal"';
                    $tableHtml .= ' data-id="' . $delivery->id . '"';
                    if ($delivery->user) {
                        if ($delivery->user->merchant_name) {
                            $merchantTitle = "Merchant's Name: ";
                            $merchantName = $delivery->user->merchant_name;
                        } elseif ($delivery->local_user_name) {
                            $merchantTitle = "Personal: ";
                            $merchantName = $delivery->local_user_name;
                        } else {
                            $merchantTitle = "Merchant's Name: ";
                            $merchantName = $delivery->user->merchant_name;
                        }
                    } else {
                        $merchantTitle = "Personal: ";
                        $merchantName = $delivery->local_user_name;
                    }
                    $tableHtml .= 'data-merchant_name="' . $merchantName . '" ';

                    if ($delivery->user) {
                        if ($delivery->user->phone) {
                            $merchantContact = $delivery->user->phone;
                        } elseif ($delivery->local_user_contact) {
                            $merchantContact = $delivery->local_user_contact;
                        } else {
                            $merchantContact = $delivery->user->phone;
                        }
                    } else {
                        $merchantContact = $delivery->local_user_contact;
                    }
                    $tableHtml .= 'data-merchant_phone="' . $merchantContact . '" ';
                    if ($delivery->user) {
                        if ($delivery->user->email) {
                            $merchantEmail = $delivery->user->email;
                        } elseif ($delivery->local_user_email) {
                            $merchantEmail = $delivery->local_user_email;
                        } else {
                            $merchantEmail = $delivery->user->email;
                        }
                    } else {
                        $merchantEmail = $delivery->local_user_email;
                    }
                    $tableHtml .= 'data-merchant_email="' . $merchantEmail . '" ';
                    $merchantAddress = '';
                    if ($delivery->user) {
                        if ($delivery->user->pick_up_location) {
                            $merchantAddress = $delivery->user->pick_up_location . $delivery->user->district;
                        } elseif ($delivery->local_user_address) {
                            $merchantAddress = $delivery->local_user_address;
                        } else {
                            $merchantAddress = $delivery->user->pick_up_location . $delivery->user->district;
                        }
                    } else {
                        $merchantAddress = $delivery->local_user_address;
                    }
                    $tableHtml .= 'data-merchant_address="' . $merchantAddress . '" ';
                    $tableHtml .= 'data-name="' . $delivery->customer_name . '" ';
                    $tableHtml .= 'data-phone="' . $delivery->customer_phone . '" ';
                    $tableHtml .= 'data-address="' . $delivery->full_address . '" ';
                    $tableHtml .= 'data-division="' . $delivery->divisions . '" ';
                    $tableHtml .= 'data-dis="' . $delivery->district . '" ';
                    $tableHtml .= 'data-police="' . $delivery->police_station . '" ';
                    $tableHtml .= 'data-deliveryproduct="' . $delivery->product_category . '" ';
                    $tableHtml .= 'data-del="' . $delivery->delivery_type . '" ';
                    $tableHtml .= 'data-cod="' . $delivery->cod_amount . '" ';
                    $tableHtml .= 'data-invoice="' . $delivery->invoice . '" ';
                    $tableHtml .= 'data-note="' . $delivery->note . '" ';
                    $tableHtml .= 'data-exchangeparcel="' . $delivery->exchange_status . '" ';
                    $tableHtml .= 'data-weight="' . $delivery->product_weight . '" ';
                    $tableHtml .= 'data-ordertrack="' . $delivery->order_tracking_id . '" ';
                    $tableHtml .= 'data-deliverycharge="' . $delivery->delivery_charge . '" ';
                    $tableHtml .= 'data-is_active="' . $delivery->is_active . '" ';
                    $tableHtml .= 'id="updateDeliveryForm">';
                    $tableHtml .= '<i class="fas fa-eye"></i>';
                    $tableHtml .= '</button>';

                    $tableHtml .= '<a href="' . route('admin.product.delivery.show', ['id' => $delivery->id]) . '" class="btn btn-sm btn-primary">';
                    $tableHtml .= '<i class="fa fa-print"></i>';
                    $tableHtml .= '</a>';
                    $tableHtml .= '</div>';
                } else {
                    $tableHtml .= '<a href="' . route('admin.product.delivery.show', ['id' => $delivery->id]) . '" class="btn btn-sm btn-primary">';
                    $tableHtml .= '<i class="fa fa-print"></i>';
                    $tableHtml .= '</a>';
                }
                $tableHtml .= '</td>';
                $tableHtml .= '</tr>';
            }
        } else {
            $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        }
        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        $tableHtml .= '</div>';
        return $tableHtml;
    }


    public function searchPickup(Request $request)
    {
        $searchInput = $request->input('admin_delivery_search');
        $pickupmen = Pickupman::where('pickupman_name', 'like', '%' . $searchInput . '%')
            ->orWhere('phone', 'like', '%' . $searchInput . '%')
            ->orWhere('alt_phone', 'like', '%' . $searchInput . '%')
            ->orWhere('email', 'like', '%' . $searchInput . '%')
            ->orWhere('full_address', 'like', '%' . $searchInput . '%')
            ->orWhere('police_station', 'like', '%' . $searchInput . '%')
            ->orWhere('district', 'like', '%' . $searchInput . '%')
            ->orWhere('division', 'like', '%' . $searchInput . '%')
            ->get();

        $tableHtml = '<div class="table-responsive">';
        $tableHtml .= '<table class="table table-bordered" id="tableData">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">PickupMan Name</th>';
        $tableHtml .= '<th scope="col">Phone</th>';
        $tableHtml .= '<th scope="col">Alt Phone</th>';
        $tableHtml .= '<th scope="col">Email</th>';
        $tableHtml .= '<th scope="col">Full Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Profile Photo</th>';
        $tableHtml .= '<th scope="col">NID Front</th>';
        $tableHtml .= '<th scope="col">NID Back</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';

        foreach ($pickupmen as $pickupman) {
            // $tableHtml .= '<tr class="clickable-row table-info" data-id="{{ $pickupman->id }}">';
            $tableHtml .= '<tr class="clickable-row table-info" data-id="' . $pickupman->id . '">';

            $tableHtml .= '<td>' . $pickupman->id . '</td>';
            $tableHtml .= '<td>' . $pickupman->pickupman_name . '</td>';
            $tableHtml .= '<td>' . $pickupman->phone . '</td>';
            $tableHtml .= '<td>' . $pickupman->alt_phone . '</td>';
            $tableHtml .= '<td>' . $pickupman->email . '</td>';
            $tableHtml .= '<td>' . $pickupman->full_address . '</td>';
            $tableHtml .= '<td>' . $pickupman->police_station . '</td>';
            $tableHtml .= '<td>' . $pickupman->district . '</td>';
            $tableHtml .= '<td>' . $pickupman->division . '</td>';
            $tableHtml .= '<td><img src="' . asset('pickupmen/profile_images/' . $pickupman->profile_img) . '" alt="Profile photo"></td>';
            $tableHtml .= '<td><img src="' . asset('pickupmen/nid_images/' . $pickupman->nid_front) . '" alt="NID Front"></td>';
            $tableHtml .= '<td><img src="' . asset('pickupmen/nid_images/' . $pickupman->nid_back) . '" alt="NID Back"></td>';

            if ($pickupman->is_active == 1) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-black">Pending</span></td>';
            } elseif ($pickupman->is_active == 3) {
                $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-black">Cancelled</span></td>';
            } else {
                $tableHtml .= '<td><span class="badge bg-label-success me-1 text-black">Confirmed</span></td>';
            }

            $tableHtml .= '<td>';
            $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
            $tableHtml .= '<button class="btn btn-sm btn-success showButton" data-bs-toggle="modal" data-bs-target="#showModal"';
            $tableHtml .= ' data-id="' . $pickupman->id . '"';
            $tableHtml .= ' data-pickupman_name="' . $pickupman->pickupman_name . '"';
            $tableHtml .= ' data-phone="' . $pickupman->phone . '"';
            $tableHtml .= ' data-alt_phone="' . $pickupman->alt_phone . '"';
            $tableHtml .= ' data-email="' . $pickupman->email . '"';
            $tableHtml .= ' data-full_address="' . $pickupman->full_address . '"';
            $tableHtml .= ' data-police_station="' . $pickupman->police_station . '"';
            $tableHtml .= ' data-district="' . $pickupman->district . '"';
            $tableHtml .= ' data-division="' . $pickupman->division . '"';
            $tableHtml .= ' data-profile_img="' . asset('pickupmen/profile_images/' . $pickupman->profile_img) . '"';
            $tableHtml .= ' data-nid_front="' . asset('pickupmen/nid_images/' . $pickupman->nid_front) . '"';
            $tableHtml .= ' data-nid_back="' . asset('pickupmen/nid_images/' . $pickupman->nid_back) . '">';
            $tableHtml .= '<i class="fas fa-eye"></i>';
            $tableHtml .= '</button>';

            if ($pickupman->is_active == 1) {
                $tableHtml .= '<form id="pickupmanConformation" action="' . route('admin.pickupman_confirmation') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $pickupman->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fa-solid fa-check"></i></button>';
                $tableHtml .= '</form>';

                $tableHtml .= '<form id="pickupmanCancelConformation" action="' . route('admin.pickupman_cancel_confirmation') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $pickupman->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-times"></i></button>';
                $tableHtml .= '</form>';
            }

            $tableHtml .= '<form id="pickupmanDeleteConformation" action="' . route('admin.pickupman_destroy') . '" method="get">';
            $tableHtml .= csrf_field();
            $tableHtml .= '<input type="hidden" name="id" value="' . $pickupman->id . '">';
            $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm(\'Are you sure?\')"><i class="far fa-trash-alt"></i></button>';
            $tableHtml .= '</form>';

            $tableHtml .= '</div>';
            $tableHtml .= '</td>';
            $tableHtml .= '</tr>';
        }

        if ($pickupmen->isEmpty()) {
            $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        }

        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        $tableHtml .= '</div>';

        return $tableHtml;
    }

    public function searchDeliveryman(Request $request)
    {
        $searchInput = $request->input('admin_delivery_search');
        $deliverymen = Deliveryman::where('deliveryman_name', 'like', '%' . $searchInput . '%')
            ->orWhere('phone', 'like', '%' . $searchInput . '%')
            ->orWhere('alt_phone', 'like', '%' . $searchInput . '%')
            ->orWhere('email', 'like', '%' . $searchInput . '%')
            ->orWhere('full_address', 'like', '%' . $searchInput . '%')
            ->orWhere('police_station', 'like', '%' . $searchInput . '%')
            ->orWhere('district', 'like', '%' . $searchInput . '%')
            ->orWhere('division', 'like', '%' . $searchInput . '%')
            ->get();
        $tableHtml = '<div class="table-responsive">';
        $tableHtml = '<table class="table table-bordered">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Delivery Man Name</th>';
        $tableHtml .= '<th scope="col">Phone</th>';
        $tableHtml .= '<th scope="col">Alt Phone</th>';
        $tableHtml .= '<th scope="col">Email</th>';
        $tableHtml .= '<th scope="col">Full Address</th>';
        $tableHtml .= '<th scope="col">Police Station</th>';
        $tableHtml .= '<th scope="col">District</th>';
        $tableHtml .= '<th scope="col">Division</th>';
        $tableHtml .= '<th scope="col">Profile Photo</th>';
        $tableHtml .= '<th scope="col">NID Front</th>';
        $tableHtml .= '<th scope="col">NID Back</th>';
        $tableHtml .= '<th scope="col">Status</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        if (!$deliverymen->isEmpty()) {
            foreach ($deliverymen as $deliveryman) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $deliveryman->id . '</td>';
                $tableHtml .= '<td>' . $deliveryman->deliveryman_name . '</td>';
                $tableHtml .= '<td>' . $deliveryman->phone . '</td>';
                $tableHtml .= '<td>' . $deliveryman->alt_phone . '</td>';
                $tableHtml .= '<td>' . $deliveryman->email . '</td>';
                $tableHtml .= '<td>' . $deliveryman->full_address . '</td>';
                $tableHtml .= '<td>' . $deliveryman->police_station . '</td>';
                $tableHtml .= '<td>' . $deliveryman->district . '</td>';
                $tableHtml .= '<td>' . $deliveryman->division . '</td>';
                $tableHtml .= '<td><img src="' . asset('deliverymen/profile_images/' . $deliveryman->profile_img) . '" alt="Profile photo"></td>';
                $tableHtml .= '<td><img src="' . asset('deliverymen/nid_images/' . $deliveryman->nid_front) . '" alt="NID Front"></td>';
                $tableHtml .= '<td><img src="' . asset('deliverymen/nid_images/' . $deliveryman->nid_back) . '" alt="NID Back"></td>';
                if ($deliveryman->is_active == 1) {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-black">Pending</span></td>';
                } elseif ($deliveryman->is_active == 3) {
                    $tableHtml .= '<td><span class="badge bg-label-danger me-1 text-black">Cancelled</span></td>';
                } else {
                    $tableHtml .= '<td><span class="badge bg-label-success me-1 text-black">Confirmed</span></td>';
                }
                $tableHtml .= '<td>';
                $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                if ($deliveryman->is_active == 1) {
                    $tableHtml .= '<form id="deliverymanConformation" action="' . route('admin.deliveryman_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $deliveryman->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-success" type="submit"><i class="fa-solid fa-check"></i></button>';
                    $tableHtml .= '</form>';
                    $tableHtml .= '<form id="deliverymanCancelConformation" action="' . route('admin.deliveryman_cancel_confirmation') . '" method="post">';
                    $tableHtml .= csrf_field();
                    $tableHtml .= '<input type="hidden" name="id" value="' . $deliveryman->id . '">';
                    $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-times"></i></button>';
                    $tableHtml .= '</form>';
                }


                $tableHtml .= '<button class="btn btn-sm btn-success showButton" data-bs-toggle="modal" data-bs-target="#showModal"';
                $tableHtml .= ' data-id="' . $deliveryman->id . '"';
                $tableHtml .= ' data-deliveryman_name="' . $deliveryman->deliveryman_name . '"';
                $tableHtml .= ' data-phone="' . $deliveryman->phone . '"';
                $tableHtml .= ' data-alt_phone="' . $deliveryman->alt_phone . '"';
                $tableHtml .= ' data-email="' . $deliveryman->email . '"';
                $tableHtml .= ' data-full_address="' . $deliveryman->full_address . '"';
                $tableHtml .= ' data-police_station="' . $deliveryman->police_station . '"';
                $tableHtml .= ' data-district="' . $deliveryman->district . '"';
                $tableHtml .= ' data-division="' . $deliveryman->division . '"';
                $tableHtml .= ' data-profile_img="' . asset('deliverymen/profile_images/' . $deliveryman->profile_img) . '"';
                $tableHtml .= ' data-nid_front="' . asset('deliverymen/nid_images/' . $deliveryman->nid_front) . '"';
                $tableHtml .= ' data-nid_back="' . asset('deliverymen/nid_images/' . $deliveryman->nid_back) . '">';
                $tableHtml .= '<i class="fas fa-eye"></i>';
                $tableHtml .= '</button>';



                $tableHtml .= '<form id="deliverymanDeleteConformation" action="' . route('admin.deliveryman_destroy') . '" method="get">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $deliveryman->id . '">';
                $tableHtml .= '<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm(\'Are you sure?\')"><i class="far fa-trash-alt"></i></button>';
                $tableHtml .= '</form>';
                $tableHtml .= '</div>';
                $tableHtml .= '</td>';
                $tableHtml .= '</tr>';
            }
        } else {
            $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        }
        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        $tableHtml .= '</div>';

        return $tableHtml;
        // return response()->json(['deliverymen' => $deliverymen]);
    }

    public function searchMerchant(Request $request)
    {

        $searchTerm = $request->input('admin_delivery_search');
        $users = User::where('business_name', 'LIKE', "%$searchTerm%")
            ->orWhere('merchant_name', 'LIKE', "%$searchTerm%")
            ->orWhere('pick_up_location', 'LIKE', "%$searchTerm%")
            ->orWhere('phone', 'LIKE', "%$searchTerm%")
            ->orWhere('email', 'LIKE', "%$searchTerm%")
            ->paginate(10);
        $tableHtml = '<div class="table-responsive">';
        $tableHtml .= '<table class="table table-light table-hover display nowrap" id="table" style="width:100%">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Business Name</th>';
        $tableHtml .= '<th scope="col">Merchant Name</th>';
        $tableHtml .= '<th scope="col">Phone</th>';
        $tableHtml .= '<th scope="col">Email</th>';
        $tableHtml .= '<th scope="col">Pick Up Location</th>';
        $tableHtml .= '<th scope="col">Profile Photo</th>';
        $tableHtml .= '<th scope="col">NID Front</th>';
        $tableHtml .= '<th scope="col">NID Back</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        foreach ($users as $user) {
            $tableHtml .= '<tr class="table-info">';
            $tableHtml .= '<td>' . $user->id . '</td>';
            $tableHtml .= '<td>' . $user->business_name . '</td>';
            $tableHtml .= '<td>' . $user->merchant_name . '</td>';
            $tableHtml .= '<td>' . $user->phone . '</td>';
            $tableHtml .= '<td>' . $user->email . '</td>';
            $tableHtml .= '<td>' . $user->pick_up_location . '</td>';
            $tableHtml .= '<td><img src="' . asset('merchant/profile-photos/' . $user->profile_img) . '" alt="Profile Photo"></td>';
            $tableHtml .= '<td><img src="' . asset('merchant/nid-photos/' . $user->nid_front) . '" alt="NID Front"></td>';
            $tableHtml .= '<td><img src="' . asset('merchant/nid-photos/' . $user->nid_back) . '" alt="NID Back"></td>';
            $tableHtml .= '<td>';
            $tableHtml .= '<button class="btn btn-sm btn-success showButton" data-bs-toggle="modal" data-bs-target="#showModal"';
            $tableHtml .= ' data-id="' . $user->id . '"';
            $tableHtml .= ' data-business_name="' . $user->business_name . '"';
            $tableHtml .= ' data-merchant_name="' . $user->merchant_name . '"';
            $tableHtml .= ' data-phone="' . $user->phone . '"';
            $tableHtml .= ' data-email="' . $user->email . '"';
            $tableHtml .= ' data-pick_up_location="' . $user->pick_up_location . '"';
            $tableHtml .= ' data-profile_img="' . asset('merchant/profile-photos/' . $user->profile_img) . '"';
            $tableHtml .= ' data-nid_front="' . asset('merchant/nid-photos/' . $user->nid_front) . '"';
            $tableHtml .= ' data-nid_back="' . asset('merchant/nid-photos/' . $user->nid_back) . '">';
            $tableHtml .= '<i class="fas fa-eye"></i>';
            $tableHtml .= '</button>';
            $tableHtml .= '</td>';
            $tableHtml .= '</tr>';
        }
        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        $tableHtml .= $users->onEachSide(1)->links();
        $tableHtml .= '</div>';
        return $tableHtml;

        //return response()->json(['user' => $user]);
    }

    public function adminSearch(Request $request)
    {

        $searchTerm = $request->input('admin_delivery_search');
        $deliveries = Admin::where('designation', 'LIKE', "%$searchTerm%")
            ->orWhere('admin_name', 'LIKE', $searchTerm)  // Use '=' for exact match
            ->orWhere('phone', 'LIKE', "%$searchTerm%")
            ->orWhere('email', 'LIKE', "%$searchTerm%")
            ->get();

        $tableHtml = '<table class="table table-light table-hover" id="table">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">Name</th>';
        $tableHtml .= '<th scope="col">Designation</th>';
        $tableHtml .= '<th scope="col">Phone</th>';
        $tableHtml .= '<th scope="col">Email</th>';
        $tableHtml .= '<th scope="col">Delete</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        if (!$deliveries->isEmpty()) {
            foreach ($deliveries as $admin) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $admin->id . '</td>';
                $tableHtml .= '<td>' . $admin->admin_name . '</td>';
                $tableHtml .= '<td>' . $admin->designation . '</td>';
                $tableHtml .= '<td>' . $admin->phone . '</td>';
                $tableHtml .= '<td>' . $admin->email . '</td>';
                $tableHtml .= '<td>';
                $tableHtml .= '<form id="adminDeleteConformation" action="' . route('admin.destroy') . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= '<input type="hidden" name="id" value="' . $admin->id . '">';
                $tableHtml .= '<tableHtml class="btn btn-sm btn-danger" type="submit" onclick="return confirm(\'Are you sure want to delete admin?\')">';
                $tableHtml .= '<i class="fas fa-trash-alt"></i>';
                $tableHtml .= '</tableHtml>';
                $tableHtml .= '</form>';
                $tableHtml .= '</td>';
                $tableHtml .= '</tr>';
            }
        } else {
            $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        }
        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        return $tableHtml;
        // return response()->json(['deliveries' => $deliveries]);
    }

    public function calculatorSearch(Request $request)
    {
        $searchTerm = $request->input('admin_delivery_search');

        $results = Deliverycharge::where('id', 'LIKE', "%$searchTerm%")
            ->orWhere('from_location', 'LIKE', "%$searchTerm%")
            ->orWhere('destination', 'LIKE', "%$searchTerm%")
            ->orWhere('category', 'LIKE', "%$searchTerm%")
            ->orWhere('delivery_type', 'LIKE', "%$searchTerm%")
            ->orWhere('cost', 'LIKE', "%$searchTerm%")
            ->orWhere('weight', 'LIKE', "%$searchTerm%")
            ->get();
        $tableHtml = '<table class="table table-bordered" id="table">';
        $tableHtml .= '<thead>';
        $tableHtml .= '<tr>';
        $tableHtml .= '<th scope="col">ID</th>';
        $tableHtml .= '<th scope="col">From</th>';
        $tableHtml .= '<th scope="col">Destination</th>';
        $tableHtml .= '<th scope="col">Category</th>';
        $tableHtml .= '<th scope="col">Delivery Type</th>';
        $tableHtml .= '<th scope="col">Delivery Cost</th>';
        $tableHtml .= '<th scope="col">Action</th>';
        $tableHtml .= '</tr>';
        $tableHtml .= '</thead>';
        $tableHtml .= '<tbody>';
        if (!$results->isEmpty()) {
            foreach ($results as $calculate) {
                $tableHtml .= '<tr class="table-info">';
                $tableHtml .= '<td>' . $calculate->id . '</td>';
                $tableHtml .= '<td>' . $calculate->from_location . '</td>';
                $tableHtml .= '<td>' . $calculate->destination . '</td>';
                $tableHtml .= '<td>' . $calculate->category . '</td>';
                $tableHtml .= '<td>' . $calculate->delivery_type . '</td>';
                $tableHtml .= '<td>' . $calculate->cost . '</td>';
                $tableHtml .= '<td>';
                $tableHtml .= '<div class="d-flex justify-content-center gap-2">';
                $tableHtml .= '<button class="btn btn-sm btn-success showButton" data-bs-toggle="modal" data-bs-target="#showModal" data-id="' . $calculate->id . '" data-fromlocation="' . $calculate->from_location . '" data-destination="' . $calculate->destination . '" data-category="' . $calculate->category . '" data-delivery_type="' . $calculate->delivery_type . '" data-cost="' . $calculate->cost . '" id="updateDeliveryForm"><i class="fas fa-eye"></i></button>';
                $tableHtml .= '<button class="btn btn-sm btn-success editDeliveryChargeButton" data-bs-toggle="modal" data-bs-target="#editModal" data-chargeid="' . $calculate->id . '" data-chargefromlocation="' . $calculate->from_location . '" data-chargedestination="' . $calculate->destination . '" data-chargecategory="' . $calculate->category . '" data-chargedeliverytype="' . $calculate->delivery_type . '" data-chargecost="' . $calculate->cost . '"><i class="fas fa-pencil-alt"></i></button>';
                $tableHtml .= '<form id="chargeDeleteConformation" action="' . route('deliverycharge.destroy', $calculate->id) . '" method="post">';
                $tableHtml .= csrf_field();
                $tableHtml .= method_field('DELETE');
                $tableHtml .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i></button>';
                $tableHtml .= '</form>';
                $tableHtml .= '</div>';
                $tableHtml .= '</td>';
                $tableHtml .= '</tr>';
            }
        } else {
            $tableHtml .= '<tr><td colspan="6" class="text-center fw-bold">No data found for the selected inputs.</td></tr>';
        }

        $tableHtml .= '</tbody>';
        $tableHtml .= '</table>';
        return $tableHtml;
        // return response()->json(['results' => $results]);
    }

    // ******Pickupman controller for admin******
    public function pickupManTable()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        $pickupmans = Pickupman::paginate(10);
        return view('server.pages.pickupman-table',  compact('pickupmans', 'admin'));
    }

    public function pickupConfirmation(Request $request)
    {

        $pickup = Pickupman::find($request->id);
        $pickup->is_active = 2;

        $pickup->update();
        return response()->json(['status' => 'success']);
        // return redirect('admin/pickupman');
    }

    public function pickupCancelConfirmation(Request $request)
    {

        $pickup = Pickupman::find($request->id);
        $pickup->is_active = 3;
        $pickup->update();

        // return redirect('admin/pickupman');
        return response()->json(['status' => 'success']);
    }

    public function pickupmanDestroy(Request $request)
    {
        // $pickupman = Pickupman::find($request->id);
        // $profile_path = public_path('pickupmen/profile_images/' . $pickupman->profile_img);
        // $nidfront_path = public_path('pickupmen/nid_images/' . $pickupman->nid_front);
        // $nidback_path = public_path('pickupmen/nid_images/' . $pickupman->nid_back);
        // // dd($profile_path);
        // if (file_exists($profile_path)) {
        //     unlink($profile_path);
        // }
        // if (file_exists($nidfront_path)) {
        //     unlink($nidfront_path);
        // }
        // if (file_exists($nidback_path)) {
        //     unlink($nidback_path);
        // }
        // $pickupman->delete();
        // return redirect('admin/pickupman');
        $pickupman = Pickupman::find($request->id);
        $profile_path = public_path('pickupmen/profile_images/' . $pickupman->profile_img);
        $nidfront_path = public_path('pickupmen/nid_images/' . $pickupman->nid_front);
        $nidback_path = public_path('pickupmen/nid_images/' . $pickupman->nid_back);

        if (file_exists($profile_path)) {
            unlink($profile_path);
        }
        if (file_exists($nidfront_path)) {
            unlink($nidfront_path);
        }
        if (file_exists($nidback_path)) {
            unlink($nidback_path);
        }

        $pickupman->delete();

        // Return a response indicating success
        return response()->json(['status' => 'success']);
    }


    // ******Deliveryman controller for admin******

    public function deliveryManTable()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }

        $deliverymen = Deliveryman::paginate(10);
        return view('server.pages.deliveryman-table',  compact('deliverymen', 'admin'));
    }

    public function deliverymanConfirmation(Request $request)
    {

        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->is_active = 2;

        $deliveryman->update();

        // return redirect('admin/deliveryman');
        return response()->json(['status' => 'success']);
    }

    public function deliverymanCancelConfirmation(Request $request)
    {

        $deliveryman = Deliveryman::find($request->id);
        $deliveryman->is_active = 3;
        $deliveryman->update();

        // return redirect('admin/deliveryman');
        return response()->json(['status' => 'success']);
    }

    public function deliverymanDestroy(Request $request)
    {
        $deliveryman = Deliveryman::find($request->id);
        $profile_path = public_path('deliverymen/profile_images/' . $deliveryman->profile_img);
        $nidfront_path = public_path('deliverymen/nid_images/' . $deliveryman->nid_front);
        $nidback_path = public_path('deliverymen/nid_images/' . $deliveryman->nid_back);
        // dd($profile_path);
        if (file_exists($profile_path)) {
            unlink($profile_path);
        }
        if (file_exists($nidfront_path)) {
            unlink($nidfront_path);
        }
        if (file_exists($nidback_path)) {
            unlink($nidback_path);
        }
        $deliveryman->delete();
        // return redirect('admin/deliveryman');


        // Return a response indicating success
        return response()->json(['status' => 'success']);
    }








    // ******Product Controller for Admin******

    public function productTable()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $deliveries = Product::paginate(10);
        return view('server.pages.delivery-table', compact('deliveries', 'admin'));
    }

    public function productShow(Request $request)
    {
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $product = Product::find($request->id);

        if (!$product) {
            return redirect()->back()->with('fail', 'Product not found.');
        }
        return view('server.pages.show-delivery-table', compact('product', 'admin'));
    }


    public function productTableAjex(Request $request)
    {
        if (Session::has('loginId')) {
            $admin = Admin::find(Session::get('loginId'));
        }

        // $deliveries = Product::paginate(10);
        // $deliveries = Product::with('user')->paginate(10);
        $deliveries = Product::with(['user', 'pickupman', 'deliveryman'])->paginate(10);
        // $tableContent = view('server.pages.delivery-table', compact('deliveries', 'admin'))->render();

        return response()->json(['deliveries' => $deliveries]);
    }


    public function productEdit(Request $request)
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $delivery = Product::find($request->id);
        return view('server.pages.admin-delivery-edit', compact('delivery', 'admin'));
    }
    public function admin_fraud_check()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        // $deliveryman = array();
        // if (Session::has('loginId')) {
        //     $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        // }
        // $frauds = Fraud::all();
        $frauds = Fraud::with('user', 'deliveryman', 'pickupman')->get();
        // $formattedFrauds = $frauds->map(function ($fraud) {
        //     $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
        //     return $fraud;
        // });
        // return view('server.pages.admin-delivery-edit', compact('delivery', 'admin'));
        return view('server.pages.fraud_check', compact('admin', 'frauds'));
    }

    public function admin_fraud_check_search()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.fraud_check_search', compact('admin'));
    }

    public function admin_fraud_search(Request $request)
    {
        // $request->validate([
        //     'phone_number' => 'required|numeric|digits:11',
        // ]);
        // $phone_number = $request->input('phone_number');

        // $result = Fraud::where('phone_number', '=', $phone_number)->get();
        // return response()->json(['result' => $result]);
        $request->validate([
            'phone_number' => 'required|numeric|digits:11',
        ]);

        $phone_number = $request->input('phone_number');

        $result = Fraud::with('user', 'deliveryman', 'pickupman')
            ->where('phone_number', $phone_number)
            ->get();

        return response()->json(['result' => $result]);
    }

    public function productUpdate(Request $request)
    {

        $delivery = Product::find($request->up_id);
        $delivery->product_category = $request->deliveryproduct;
        $delivery->customer_name = $request->Customer_name;
        $delivery->customer_phone = $request->phone;
        $delivery->full_address = $request->address;
        $delivery->divisions = $request->divisions;
        $delivery->district = $request->district;
        $delivery->police_station = $request->police;
        $delivery->delivery_type = $request->del;
        $delivery->cod_amount = $request->cod;
        $delivery->invoice = $request->invoice;
        $delivery->note = $request->note;
        $delivery->product_weight = $request->weight;
        $delivery->exchange_status = $request->exchangeparcel;
        $delivery->delivery_charge = $request->deliverycharge;
        $delivery->is_active = $request->is_active;

        $delivery->update();
        // return redirect('admin/product/delivery')->withSuccess('Update successfully.');
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function deliveryChargeupdate(Request $request, Deliverycharge $deliverycharge)
    {

        $delivery = Deliverycharge::find($request->id);
        $delivery->from_location = $request->from_location;
        $delivery->destination = $request->destination;
        $delivery->category = $request->category;
        $delivery->delivery_type = $request->delivery_type;
        $delivery->cost = $request->cost;
        $delivery->update();
        // return redirect('admin/product/delivery')->withSuccess('Update successfully.');
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function productDeliveryConfirmation(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 3;

        $delivery->update();

        return redirect('admin/product/delivery');
    }

    public function productDeliveryCheckout(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 4;

        $delivery->update();

        return redirect('admin/product/delivery');
    }

    public function productDeliveryDelivered(Request $request)
    {

        $delivery = Product::find($request->id);
        $delivery->is_active = 4;

        $delivery->update();

        return redirect('admin/product/delivery');
    }


    public function productCancelConfirmation(Request $request)
    {
        $delivery = Product::find($request->id);
        $delivery->is_active = 8;
        $delivery->update();
        return redirect('admin/product/delivery');
    }

    public function productDestroy(Request $request)
    {

        Product::find($request->id)->delete();
        return redirect('admin/product/delivery');
    }


    // *******Excel File Import & Export*******

    public function productExcelImport(Request $request)
    {

        Excel::Import(new ProductImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function pickupmanExcelImport(Request $request)
    {

        Excel::Import(new PickupmanImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function deliverymanExcelImport(Request $request)
    {

        Excel::Import(new DeliverymanImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function adminExcelImport(Request $request)
    {

        Excel::Import(new AdminImport, request()->file('excel_file'));
        return redirect('admin/product/delivery')->withSuccess('Excel file import successfully.');
    }

    public function productExcelExport()
    {

        return Excel::download(new ProductExport, 'products.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function pickupmanExcelExport()
    {
        return Excel::download(new PickupmaExport, 'pickupmen.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function deliverymanExcelExport()
    {

        return Excel::download(new DeliverymanExport, 'deliverymen.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function adminExcelExport()
    {

        return Excel::download(new AdminExport, 'admins.xlsx');
        // return redirect('admin/product/delivery')->withSuccess('Excel file download successfully.');

    }

    public function admin_fraud_add_new()
    {
        $deliveryman = array();
        if (Session::has('loginId')) {
            $deliveryman = Deliveryman::where('id', '=', Session::get('loginId'))->first();
        }
        return view('deliveryman.pages.fraud_add_new', compact('deliveryman'));
    }
    public function admin_fraud_add_new_insert(Request $request)
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

    public function admin_fraud_myentries()
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

    public function admin_fraud_delete($id)
    {

        $fraud = Fraud::findOrFail($id);
        $fraud->delete();
        return redirect()->back()->with('message', 'Fraud record remove successfully');
    }

    public function newsletterSubscibers()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $subscribers = Newsletter::paginate(10);
        return view('server.pages.newsletter_subscribers', compact('admin', 'subscribers'));
    }

    public function newsletterDestroy(Request $request)
    {
        $subscriber = Newsletter::find($request->id);
        $subscriber->delete();

        // Return a response indicating success
        return redirect()->back()->with('success', 'Newsletters subscribers deleted.');
    }

    public function editTerms()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $termsFilePath = resource_path('views/client/pages/terms_condition.blade.php');
        $termsContent = File::get($termsFilePath);

        return view('client.pages.terms_condition_edit', compact('termsContent', 'admin'));
    }

    public function updateTerms(Request $request)
    {
        $content = $request->input('content');
        $filePath = resource_path('views/client/pages/terms_condition.blade.php');

        File::put($filePath, $content);

        return redirect()->back()->with('success', 'Newsletter updated successfully!');
    }

    public function editAbout()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $aboutFilePath = resource_path('views/client/pages/about.blade.php');
        $aboutContent = File::get($aboutFilePath);

        return view('client.pages.about_edit', compact('aboutContent', 'admin'));
    }

    public function updateAbout(Request $request)
    {
        $content = $request->input('content');
        $filePath = resource_path('views/client/pages/about.blade.php');

        File::put($filePath, $content);

        return redirect()->back()->with('success', 'About page updated successfully!');
    }

    public function editPrivacy()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $privacyFilePath = resource_path('views/client/pages/privacy_policy.blade.php');
        $privacyContent = File::get($privacyFilePath);

        return view('client.pages.privacy_policy_edit', compact('privacyContent', 'admin'));
    }

    public function updatePrivacy(Request $request)
    {
        $content = $request->input('content');
        $filePath = resource_path('views/client/pages/privacy_policy.blade.php');

        File::put($filePath, $content);

        return redirect()->back()->with('success', 'Privacy Policy page updated successfully!');
    }

    public function range_date_search(Request $request)
    {
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }


        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Query the database
        // $results = Product::whereBetween('created_at', [$startDate, $endDate])->get();
        if ($startDate->gt($endDate)) {
            // Swap the dates if $startDate is later than $endDate
            $temp = $startDate;
            $startDate = $endDate;
            $endDate = $temp;
        }

        // Query the database
        // $deliveries = Product::whereBetween('created_at', [$startDate, $endDate])->get();
        $deliveries = Product::whereBetween('created_at', [$startDate, $endDate])->paginate(10)->onEachSide(5);

        return view('server.pages.delivery-table', compact('deliveries', 'admin'));
    }
    public function projectDelete(Request $request)
    {
        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        Product::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }
    public function projectDeletepickup(Request $request)
    {

        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        Pickupman::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }

    public function projectDeleteDeliveryman(Request $request)
    {
        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        Deliveryman::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }
    public function projectDeleteMerchant(Request $request)
    {
        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        User::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }
    public function projectDeleteAdmin(Request $request)
    {
        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        Admin::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }
    public function projectDeleteCalculate(Request $request)
    {
        $ids = $request->input('ids');
        $actualArray = json_decode($ids, true);
        Deliverycharge::whereIn('id', $actualArray)->delete();
        return redirect()->back()->with('success', 'Projects deleted successfully');
    }
}
