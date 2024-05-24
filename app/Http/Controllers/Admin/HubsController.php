<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hub;
use Illuminate\Support\Facades\Session;

class HubsController extends Controller
{
    public function hubsIndex()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $hubs = Hub::paginate(10);
        return view('server.pages.hubs_table', compact('admin', 'hubs'));
    }

    // public function newsFront()
    // {
    //     $admin = [];
    //     if (Session::has('loginId')) {
    //         $admin = Admin::where('id', '=', Session::get('loginId'))->first();
    //     }
    //     $news = News::latest()->get();
    //     return view('client.components.news', compact('admin', 'news'));
    // }


    public function hubsCreate()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.hubs_create', compact('admin'));
    }

    public function hubsStore(Request $request)
    {
        $request->validate([
            'hub_address' => 'required',
        ]);

        $hubs = new Hub();
        $hubs->hub_address = $request->hub_address;

        $hubs->save();
        return redirect()->back()->withSuccess('Hub create successfully.');
    }

    public function hubsDestroy(Request $request)
    {
        Hub::find($request->id)->delete();
        return redirect()->back()->withSuccess('Hub Deleted');
    }
}
