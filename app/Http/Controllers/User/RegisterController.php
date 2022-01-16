<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class RegisterController extends Controller{

    public function __construct(){
        $this->middleware('guest');
        $this->middleware('lang');
    }

    public function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required']
        ];

        $messages = [
            'name.required'=> Lang::get('content.youmustwriteyourname'),
            'email.required'=> Lang::get('content.youmustwriteyouremail'),
            'email.unique'=> Lang::get('content.emailisuse'),
            'password.required'=> Lang::get('content.youmustwriteyourpassword'),
            'password.string'=> Lang::get('content.passwordmustbestring'),
            'password.min'=> Lang::get('content.passwordmin'),
            'password_confirm.required'=> Lang::get('content.youmustconfirmyourpassword'),
        ];

        $request->validate($rules,$messages);

        if($request->password != $request->password_confirm){
            return redirect()->back()->withErrors(['message'=> Lang::get('content.passworddoesnotmatch')]);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = 0;

        User::create($data);

        return redirect()->route('login')->withSuccess(Lang::get('content.successfullyregistered'));

        // return redirect()->back()->with($notification);
    }
}
