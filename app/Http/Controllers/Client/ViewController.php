<?php

namespace App\Http\Controllers\Client;

use App\Models\Deliverycharge;
use App\Http\Controllers\Controller;
use App\Mail\SendLocalUserMail;
use App\Models\Admin;
use App\Models\Hub;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ViewController extends Controller
{
    public function home()
    {
        $fromLocations = Deliverycharge::select('from_location')->distinct()->get();
        return view('welcome', compact('fromLocations'));
    }

    public function getDestinations(Request $request)
    {

        $destinations = Deliverycharge::where('from_location', $request->from_location)->select('destination')->distinct()->get();
        return response()->json($destinations);
    }

    public function getCategories(Request $request)
    {

        $categories = Deliverycharge::where('destination', $request->destination)->select('category')->distinct()->get();
        return response()->json($categories);
    }

    public function getServices(Request $request)
    {

        $services = Deliverycharge::where('destination', $request->destination)->select('delivery_type')->distinct()->get();
        return response()->json($services);
    }

    public function tracking()
    {
        return view('client.pages.tracking');
    }

    public function contact()
    {
        return view('client.pages.contact');
    }

    public function service()
    {
        return view('client.pages.service');
    }
    public function about()
    {
        return view('client.pages.about');
    }

    public function privacyPolicy()
    {
        return view('client.pages.privacy_policy');
    }

    public function termsCondition()
    {
        return view('client.pages.terms_condition');
    }

    public function business()
    {
        return view('client.pages.business_account');
    }

    public function driver()
    {
        return view('client.pages.driver_account');
    }

    public function parcelBooking()
    {
        $id = Auth::id();
        $uuid = Uuid::uuid4()->toString();
        $uuid = str_replace("-", "", $uuid);
        $firstFiveChars = substr($uuid, 0, 5);
        $numericValue = hexdec($firstFiveChars);

        $firstTwoChars = substr($uuid, 0, 2);
        $lastFiveChars = substr($uuid, -5);
        $lettersValue = hexdec($firstTwoChars);

        $firstTwoChars = preg_replace("/[^a-zA-Z]/", "", $firstTwoChars);
        $lastFiveChars = preg_replace("/[^0-9]/", "", $lastFiveChars);

        $uniqueValue = $firstTwoChars . $lastFiveChars;

        $hubs = Hub::all();
        return view('client.pages.parcel_booking', compact('id', 'numericValue', 'hubs', 'uniqueValue'));
    }

    public function parcelBookingStore(Request $request)
    {
        $request->validate([
            'local_user_name' => 'required|string|max:255',
            'local_user_contact' => 'required',
            'local_user_email' => 'required',
            'local_user_address' => 'required',
            'product_category' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'customer_email' => 'required',
            'full_address' => 'required|string|max:255',
            'divisions' => 'required|string',
            'district' => 'required|string',
            'police_station' => 'required|string',
            'delivery_type' => 'required|string',
            'cod_amount' => 'required|numeric',
            'invoice' => 'required|string',
            'note' => 'required|string',
            'product_weight' => 'required',
            'exchange_status' => 'required',
        ]);
        $number = mt_rand(1000000000, 9999999999);
        
        if($this->productCodeExists($number)){
            $number = mt_rand(1000000000, 999999999);
        }
        $request['product_bar_code'] = $number;

        $localUser = Product::create($request->all());
        Mail::to($localUser->local_user_email)->send(new SendLocalUserMail($localUser));

        return redirect()->back()->with('success', "Parcel added successfully. Check your email.");
    }

    public function productCodeExists($number){
        return Product::whereProductBarCode($number)->exists();
    }

    public function faq()
    {
        $faqs = [
            ['question' => 'Why Fast Move Logistics?', 'answer' => "Fast Move Logistics Ltd, your trusted partner in nationwide parcel delivery. At Fast Move, we're dedicated to ensuring your parcels reach their destinations swiftly and securely, without any hassle. Our commitment to excellence is evident in every aspect of our service: Prompt Delivery, Effortless Tracking, Dedicated Support, Secure Handling."],
            ['question' => 'What are your shipping rates?', 'answer' => " Our shipping rates vary depending on factors such as the destination, weight, and dimensions of the package. To get an accurate quote, you can use our online shipping calculator or contact our customer support team for assistance."],
            ['question' => 'How long does it take for my package to arrive?', 'answer' => " Delivery times vary based on the shipping method selected and the destination of the package. We offer a range of shipping options, including standard and express delivery, with estimated delivery times provided during checkout."],
            ['question' => 'How can I track my shipment?', 'answer' => "You can easily track your shipment by using our online tracking system. Simply visit our website's tracking page and enter your tracking number to get updates on the status."],
        ];
    
        return View::make('client.pages.faq', compact('faqs'));
    }

    public function faq2()
    {
        $faqs = [
            ['question' => 'Why Fast Move Logistics?', 'answer' => "Fast Move Logistics Ltd, your trusted partner in nationwide parcel delivery. At Fast Move, we're dedicated to ensuring your parcels reach their destinations swiftly and securely, without any hassle. Our commitment to excellence is evident in every aspect of our service: Prompt Delivery, Effortless Tracking, Dedicated Support, Secure Handling."],
            ['question' => 'What are your shipping rates?', 'answer' => " Our shipping rates vary depending on factors such as the destination, weight, and dimensions of the package. To get an accurate quote, you can use our online shipping calculator or contact our customer support team for assistance."],
            ['question' => 'How long does it take for my package to arrive?', 'answer' => " Delivery times vary based on the shipping method selected and the destination of the package. We offer a range of shipping options, including standard and express delivery, with estimated delivery times provided during checkout."],
            ['question' => 'How can I track my shipment?', 'answer' => "You can easily track your shipment by using our online tracking system. Simply visit our website's tracking page and enter your tracking number to get updates on the status."],
        ];
    
        return View::make('client.components.faq', compact('faqs'));
    }

    public function newsIndex()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $news = News::paginate(10);
        return view('server.pages.news_table', compact('admin', 'news'));
    }

    public function newsFront()
    {
        $admin = [];
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $news = News::latest()->get();
        return view('client.components.news', compact('admin', 'news'));
    }


    public function newsCreate()
    {

        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        return view('server.pages.news_create', compact('admin'));
    }

    public function newsStore(Request $request)
    {
        $uuid = Str::uuid();
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;

        if ($request->hasFile('news_image')) {
            $file = $request->file('news_image');
            $filename = $uuid . '_' . $request->news_image->getClientOriginalName();
            $file->move('admins/news_images/', $filename);
            $news->news_image = $filename;
        }

        $news->save();
        return redirect()->back()->withSuccess('News create successfully.');
    }

    public function newsDestroy(Request $request)
    {
        News::find($request->id)->delete();
        return redirect()->back()->withSuccess('News Deleted');
    }

}
