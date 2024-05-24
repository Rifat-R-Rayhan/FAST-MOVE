<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;


class AccountDeletionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'password.confirm']);
    }

    public function index()
    {
        try {
            return view('client.auth.account-delete');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }

    public function destroy()
    {
        try {
            auth()->user()->delete();
            return redirect()->route('register');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
