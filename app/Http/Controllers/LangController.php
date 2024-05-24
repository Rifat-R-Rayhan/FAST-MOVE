<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as FacadesApp;

class LangController extends Controller
{
    public function lang()
    {
        return view('lang');
    }

    public function lang_change(Request $request)
    {
        FacadesApp::setLocale($request->lang);
        session()->put('lang_code', $request->lang);
        return redirect()->back();
    }
}
