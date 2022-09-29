<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function index($locale = 'en')
    // {
    //     App::setLocale($locale);
    //     return view('admin.index');
    // }

    public function index()
    {

        // if (Auth::user()->type == 'user') {
        //    return redirect('/');
        // }
        // dd(Auth::user()->type);
        return view('admin.index');
    }
}
