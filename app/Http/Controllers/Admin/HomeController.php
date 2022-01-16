<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(){
        $admin_count = User::where('is_admin',1)->count();
        $client_count = User::where('is_admin',0)->count();
        $news_count = News::count();
        return view('admin.dashboard', compact(['admin_count', 'client_count', 'news_count']));
    }
}
