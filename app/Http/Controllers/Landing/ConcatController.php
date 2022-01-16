<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ConcatController extends Controller{

    public function __construct(){
        $this->middleware('lang');
    }

    public function store(Request $request){

        if(trim($request->name == '')){
            return redirect()->back()->withErrors(['message'=> Lang::get('content.youmustwriteyourname')]);
        }

        if(trim($request->email == '')){
            return redirect()->back()->withErrors(['message'=> Lang::get('content.youmustwriteyouremail')]);
        }

        if(trim($request->message == '')){
            return redirect()->back()->withErrors(['message'=> Lang::get('content.youmustwriteyourmessage')]);
        }

        $contact = new \App\Models\Concat;
        $contact->name = trim($request->name);
        $contact->email = trim($request->email);
        $contact->message = trim($request->message);
        $contact->save();

        return redirect()->back()->withSuccess(Lang::get('content.themessagehasbeensent'));
    }
}
