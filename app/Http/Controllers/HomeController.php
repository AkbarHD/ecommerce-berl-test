<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homeadmin()
    {
        return view('admin.homeadmin');
    }

    public function profile()
    {
         $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }
}
