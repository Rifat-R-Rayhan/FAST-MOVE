<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMail;
use App\Models\Admin;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        $newsletter = Newsletter::create([
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Subscription successful!');
    }

    public function sendNewsletter()
    {
        $subscribers = Newsletter::all();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail());
        }
        return redirect()->back()->with('success', 'Newsletter sent successfully to all subscribers!');
    }

    public function sendSingleNewsletter($subscriberId)
    {
        $subscriber = Newsletter::find($subscriberId);

        if (!$subscriber) {
            return redirect()->back()->with('error', 'Subscriber not found!');
        }

        Mail::to($subscriber->email)->send(new NewsletterMail());
        
        return redirect()->back()->with('success', 'Newsletter sent successfully to '.$subscriber->email.'!');
    }

    public function sendSelectedNewsletters(Request $request)
    {
        $selectedIds = $request->input('selected_newsletters');

        if (!$selectedIds) {
            return redirect()->back()->with('error', 'No newsletters selected!');
        }

        $subscribers = Newsletter::whereIn('id', $selectedIds)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail());
        }

        return redirect()->back()->with('success', 'Selected newsletters sent successfully!');
    }


    public function editNewsletter()
    {
        $admin = array();
        if (Session::has('loginId')) {
            $admin = Admin::where('id', '=', Session::get('loginId'))->first();
        }
        $newsletterFilePath = resource_path('views/emails/newsletter.blade.php');
        $newsletterContent = File::get($newsletterFilePath);

        return view('server.pages.newsletter_edit', compact('newsletterContent', 'admin'));
    }

    public function updateNewsletter(Request $request)
    {
        $content = $request->input('content');
        $filePath = resource_path('views/emails/newsletter.blade.php');
        
        File::put($filePath, $content);

        return redirect()->back()->with('success', 'Newsletter updated successfully!');
    }
}
