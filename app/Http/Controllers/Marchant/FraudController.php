<?php

namespace App\Http\Controllers\Marchant;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Deliveryman;
use App\Models\Fraud;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FraudController extends Controller
{
    public function fraud_check()
    {

        $frauds = Fraud::all();
        $formattedFrauds = $frauds->map(function ($fraud) {
            $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
            return $fraud;
        });
        return view('marchant.pages.fraud_check', compact('formattedFrauds'));
    }
    public function fraud_add_new()
    {

        $user_id = Auth::user()->id;
        return view('marchant.pages.fraud_add_new', compact('user_id'));
    }
    public function fraud_add_new_insert(Request $request)
    {

        Validator::make($request->all(), [
            'phone_number' => 'required',
            'disputant_name' => 'required',
            'details' => 'required',
            'steadfast_parcel_id' => 'nullable',
            'user_id' => 'nullable',
        ]);
        $fraud = new Fraud();
        $fraud->phone_number = $request->phone_number;
        $fraud->disputant_name = $request->disputant_name;
        $fraud->details = $request->details;
        $fraud->fast_move_parcel_id = $request->steadfast_parcel_id;
        $fraud->user_id = $request->user_id;
        $fraud->save();
        return redirect()->back()->with('message', 'Fraud Added Successfully');
    }
    public function fraud_check_search()
    {

        return view('marchant.pages.fraud_check_search');
    }
    public function fraud_myentries()
    {

        $id = Auth::user()->id;
        $frauds = Fraud::where('user_id', '=', $id)->get();
        $formattedFrauds = $frauds->map(function ($fraud) {
            $fraud->formattedPhoneNumber = substr($fraud->phone_number, 0, 5) . '***' . substr($fraud->phone_number, -3);
            return $fraud;
        });
        return view('marchant.pages.myentries', compact('formattedFrauds'));
    }
    public function fraud_search(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric|digits:11',
        ]);
        $phone_number = $request->input('phone_number');

        $result = Fraud::where('phone_number', '=', $phone_number)->get();
        return response()->json(['result' => $result]);
    }
    public function fraud_delete($id)
    {

        $fraud = Fraud::findOrFail($id);
        $fraud->delete();
        return redirect()->back()->with('message', 'Fraud record remove successfully');
    }
}
