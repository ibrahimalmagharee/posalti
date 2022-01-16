<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('lang');
    }

    public function index(){
        $links = \App\Models\Social::all();
        return view('landing.index', compact(['links']));
    }

    public function contact(){
        $links = \App\Models\Social::all();
        return view('landing.contact', compact('links'));
    }

    public function register(){
        $links = \App\Models\Social::all();

        if(\Auth::check()){
            return view('landing.index', compact('links'));
        }

        return view('landing.register', compact('links'));
    }

    public function login(){
        $links = \App\Models\Social::all();

        if(\Auth::check()){
            return view('landing.index', compact('links'));
        }

        return view('landing.login', compact('links'));
    }
}
