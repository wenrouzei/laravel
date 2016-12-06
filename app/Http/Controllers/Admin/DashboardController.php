<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.dashboard.index',['username'=>Auth::guard('admin')->user()->name]);
        // dd('后台首页，当前用户名：'.Auth::guard('admin')->user()->name);
        // dd('后台首页，当前用户名：'.auth('admin')->user()->name);
    }
}