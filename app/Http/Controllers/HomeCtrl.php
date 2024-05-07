<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeCtrl extends Controller
{
    public function signup(Request $request)
    {
        return view('home');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['SuperAdmin', 'Admin', 'Editor', 'Sales']);
        return view('layouts.index');
    }

    /*
      public function someAdminStuff(Request $request)
      {
        $request->user()->authorizeRoles('manager');
        return view(‘some.view’);
      }
      */
}
