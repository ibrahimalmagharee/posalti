<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewController extends Controller{

    public function __construct(){
        $this->middleware('lang');
    }

    public function index(){
        $links = \App\Models\Social::all();
        $news = \App\Models\News::orderBy('created_at' ,'DESC')->get();
        return view('landing.news.index', compact('links', 'news'));
    }

    public function show($locale, $new){
        $new = \App\Models\News::where('id', $new)->orWhere('slug_ar', $new)->orWhere('slug_en', $new)->first();
        $news = \App\Models\News::where('id', '!=', $new->id)->take(5)->latest()->get();
        $links = \App\Models\Social::all();
        return view('landing.news.show', compact(['links', 'new', 'news']));
    }
}
