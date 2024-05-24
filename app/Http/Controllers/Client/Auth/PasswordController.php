<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        try {
            return view('client.auth.change-password');
        } catch (\Throwable $th) {
            return view('marchant.pages.404');
        }
    }
}
