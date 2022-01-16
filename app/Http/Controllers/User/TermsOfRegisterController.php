<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsOfRegisterController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
        $this->middleware('lang');
    }

    public function index(){
        $links = \App\Models\Social::all();
        return view('user.termsofregister', compact('links'));
    }
}
