<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller{

    public function __construct(){
        $this->middleware('lang');
    }

    public function index(){
        return view('auth.admin.login');
    }
}
