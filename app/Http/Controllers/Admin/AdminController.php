<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $admins= User::where('is_admin',1)->get();

        if ($request->ajax()) {

            return DataTables::of(User::where('is_admin',1)->get())
                ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                })
                //->addIndexColumn()
                ->addColumn('actions', function ($admin) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/en/admin/'.$admin->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                        <a href="javascript:void(0)" data-id="' . $admin->id . '" class="dropdown-item deleteAdmin"><i class="ft-trash-2"></i> Delete</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.user.admin.index',compact('admins'));
    }

    public function store(Request $request){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirm' => ['required', 'string', 'min:6']
        ];

        $messages = [
            'name.required'=>'You must add the name',
            'email.required'=>'You must add the email',
            'password' => 'You must add the password',
            'password_confirm' => 'You must confirm the password',
        ];

        $request->validate($rules,$messages);

        if($request->password != $request->password_confirm){
            return redirect()->back()->withErrors(['message' => 'Password does not match']);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['is_admin'] = 1;
        $data['user_id'] = Auth::user()->id;

        User::create($data);

        $notification = array(
            'message' => 'Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.index')->with($notification);
    }

    public function create(){
        return view('admin.user.admin.create');
    }

    public function edit(User $user){
        $admin = $user;
        return view('admin.user.admin.create',compact('admin'));
    }

    public function update(Request $request,User $user){

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ];

        $messages = [
            'name.required'=>'You must add the name',
            'email.required'=>'You must add the email',
        ];

        if($request->password || $request->password_confirm){

            $rules+=[
                  'password' => [ 'min:6'],
            ];

            if($request->password != $request->password_confirm){
                return redirect()->back()->withErrors(['message' => 'Password does not match']);
            }
        }

        $request->validate($rules, $messages);

        $data = $request->all();

        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        $user->update($data);

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.index')->with($notification);
    }

    public function destroy(User $user){

        if($user->id == auth::user()->id){
            return response()->json([
                'status' => false,
                'msg' => 'You can not delete yourself'
            ]);
        }

        $user->news()->delete();
        $user->delete();
        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully'
        ]);
    }
}

