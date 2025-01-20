<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    //
    public function index(){
        $setting = DB::table('pengaturans')->where('id', 1)->first();
        return view('backend.dashboard',compact('setting'));
    }
}
