<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class SettingsController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
        $this->middleware('lang');
    }

    public function account_information(){
        $links = \App\Models\Social::all();
        return view('user.account-information', compact('links'));
    }

    public function update_information(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(\Auth::user()->id)],
        ];

        $messages = [
            'name.required' => Lang::get('content.youmustwriteyourname'),
            'email.required' => Lang::get('content.youmustwriteyouremail'),
        ];

        $request->validate($rules, $messages);

        \Auth::user()->name = trim($request->name);
        \Auth::user()->email = trim($request->email);
        \Auth::user()->save();

        return redirect()->route('user.accountInformation')->withSuccess(Lang::get('content.Your data has been modified successfully'));
    }

    public function password(){
        $links = \App\Models\Social::all();
        return view('user.change-password', compact('links'));
    }

    public function change_password(Request $request){

        $rules = [
            'old_password' => ['required', 'string', 'min:6'],
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6'],
        ];

        $messages = [
            'old_password.required' => Lang::get('content.You must add the old password'),
            'new_password.required '=> Lang::get('content.You must add the new password'),
            'confirm_password.required '=> Lang::get('content.youmustconfirmyourpassword'),
        ];

        $request->validate($rules, $messages);

        if($request->new_password != $request->confirm_password){
            return redirect()->back()->withErrors(['message' => Lang::get('content.passworddoesnotmatch')]);
        }

        $result_success =  Hash::check($request->old_password, \Auth::user()->password);
        if(!$result_success){
            return redirect()->back()->withErrors(['message' => Lang::get('content.The old password is wrong')]);
        }

        \Auth::user()->password = Hash::make($request->new_password);
        \Auth::user()->save();

        return redirect()->route('user.changePassword')->withSuccess(Lang::get('content.Password has been modified successfully'));
    }
}
