<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Payment;
use App\Models\Product;
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
        $c_count = category::count();
        $p_count = Product::count();
        $m_earning = Payment::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total');
        $y_earning = Payment::whereYear('created_at', date('Y'))->sum('total');

        return view('admin.index', compact('c_count', 'p_count', 'm_earning', 'y_earning'));
        // return view('admin.index');
    }
}
