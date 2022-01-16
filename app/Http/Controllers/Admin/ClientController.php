<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class ClientController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $clients= User::where('is_admin', 0)->get();
        if ($request->ajax()) {

            return DataTables::of(User::where('is_admin',0)->get())
                ->editColumn('user_id', function ($client) {
                    return $client->user ? $client->user->name : 'Login by the user';
                })
                ->editColumn('last_financial_value', function ($client) {
                    $financial_user = \App\Models\Financial::where('user_id', $client->id)->get()->last();
                    return $financial_user ? $financial_user->value : '-';
                })
                ->editColumn('last_financial_status', function ($client) {
                    $financial_user = \App\Models\Financial::where('user_id', $client->id)->get()->last();
                    if($financial_user){
                        if($financial_user->status){
                            return "Paid";
                        }else{
                            return "Not paid";
                        }
                    }else{
                        return "-";
                    }
                })
                ->addColumn('actions', function ($client) {
                    $btn = '<td>
                                <span class="dropdown">
                                    <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                    <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="/en/admin/client/'.$client->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                                        <a href="javascript:void(0)" data-id="' . $client->id . '" class="dropdown-item deleteClient"><i class="ft-trash-2"></i> Delete</a>
                                        <a href="javascript:void(0)" data-id="' . $client->id . '" class="dropdown-item addAmountToBePaidClient"><i class="ft-add-2"></i> Add amount</a>
                                    </span>
                                </span>
                            </td>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $titles = FinancialTitle::all();
        return view('admin.user.client.index',compact(['clients', 'titles']));
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
        $data['is_admin'] = 0;
        $data['user_id'] = Auth::user()->id;

        User::create($data);
        $notification = array(
            'message' => 'Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('client.index')->with($notification);
    }

    public function create(){
        $titles = FinancialTitle::all();

        return view('admin.user.client.create', compact('titles'));
    }

    public function edit(User $user){
        $client = $user;

        $titles = FinancialTitle::all();
        return view('admin.user.client.create',compact(['client', 'titles']));
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

        $request->validate($rules,$messages);

        $data = $request->all();

        $data['password'] = $request->password?Hash::make($request->password):$user->password;
        $user->update($data);

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('client.index')->with($notification);
    }

    public function destroy(User $user){
        $user->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully'
        ]);
    }
}

