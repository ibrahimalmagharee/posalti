<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function create(){
        return view('admin.profile.edit');
    }

    public function update(Request $request){

        if(trim($request->password) != '' && trim($request->confirm_password) == ''){
            return redirect()->back()->withErrors(['message' => 'You must confirm your password']);
        }

        if(trim($request->password) != '' && trim($request->confirm_password) != ''){
            if(trim($request->password) != trim($request->confirm_password)){
                return redirect()->back()->withErrors(['message' => 'Password does not match']);
            }

            if(strlen(trim($request->password)) < 6 && strlen(trim($request->confirm_password)) < 6){
                return redirect()->back()->withErrors(['message' => 'The password must be at least 6 characters long.']);
            }
        }

        $rules = [
            'name'=> 'required',
            'email'=> 'required',
        ];

         $messages = [
            'name.required' => 'You must add a name',
            'name.required' => 'You must add a email',
        ];

        $request->validate($rules,$messages);

        $admin = User::find(auth::user()->id);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password
        ]);

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
