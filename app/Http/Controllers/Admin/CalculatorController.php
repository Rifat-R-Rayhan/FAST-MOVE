<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Deliverycharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $calculates = Deliverycharge::paginate(10);
        return view('server.pages.calculator-table', compact('calculates', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('server.pages.calculator-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Calculator::create($request->all());

        // $request->validate([
        //     'from'=>'required',
        //     'destination'=>'required',
        //     'category'=>'required',
        //     'service'=>'required',
        //     'weight'=>'required',
        //     'price'=>'required',
        // ]);

        // return redirect('calculator/create')->withSuccess('Delivery charge added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deliverycharge $deliverycharge)
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.calculator-show', compact('deliverycharge', 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deliverycharge $deliverycharge)
    {

        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.calculator-edit', compact('deliverycharge', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deliverycharge $deliverycharge)
    {

        $deliverycharge->update($request->all());
        // return redirect('deliverycharge')->withSuccess('Update successfully.');
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deliverycharge $deliverycharge)
    {

        $deliverycharge->delete();
        return redirect('deliverycharge')->withSuccess('Delete successfully.');
    }

    // public function search(Request $request, Calculator $calculator){

    //     $search = $request->search;
    //     $calculator = Calculator::where ( 'from', 'LIKE', '%' . $search . '%' )->orWhere ( 'destination', 'LIKE', '%' . $search . '%' )->get ();
    //     return view('marchant/pages/delivery-charge-table', compact('calculator'));
    // }
}
