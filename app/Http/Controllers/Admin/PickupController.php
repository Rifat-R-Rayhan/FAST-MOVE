<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pickupman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedIn');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $pickups = Pickupman::paginate(10);
        return view('server.pages.pickupman-table', compact('pickups', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $users = User::all();
        return view('server.pages.pickupman-create', compact('users', 'admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required',
            'phone' => 'required|string|max:15',
            'alt_phone' => 'required|string|max:15',
            'email' => 'required',
            'address' => 'required|string|max:255',
            'divisions' => 'required|string',
            'district' => 'required|string',
            'ps' => 'required|string',
        ]);
        $pickup = new Pickupman($request->all());

        $pickup->save();

        return redirect()->route('pickup.index')->with('success', 'Pickup Man created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pickupman $pickup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pickupman $pickup)
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.pickupman-edit', compact('pickup', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pickupman $pickup)
    {

        $pickup->update($request->all());
        return redirect('pickup')->withSuccess('Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pickupman $pickup)
    {
        $pickup->delete();
        return redirect('pickup')->withSuccess('Delete successfully.');
    }
}
