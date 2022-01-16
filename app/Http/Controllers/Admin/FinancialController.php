<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialTitle;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FinancialController extends Controller{

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $financials = \App\Models\Financial::orderBy('created_at' ,'DESC')->paginate(20);

        if ($request->ajax()) {
            return DataTables::of(\App\Models\Financial::orderBy('created_at' ,'DESC')->get())
                ->editColumn('user_id', function ($financial) {
                    return $financial->user->name;
                })
                ->editColumn('title_id', function ($financial) {
                    return $financial->title->title_en;
                })
                ->editColumn('created_by', function ($financial) {
                    return $financial->createdBy->name;
                })
                ->editColumn('status', function ($financial) {
                    return $financial->status ? "Paid" : "Not paid";
                })
                ->addColumn('payment_value', function($financial){
                    return $financial->title->value;
                })
                ->addColumn('actions', function ($financial) {
                    if($financial->status !== 1){
                        $btn = '<td>
                        <span class="dropdown">
                          <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                          <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                            <a href="/en/admin/financial/'.$financial->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                            <a href="javascript:void(0)" data-id="' . $financial->id . '" class="dropdown-item deleteFinancial"><i class="ft-trash-2"></i> Delete</a>
                          </span>
                        </span>
                      </td>';
                    }else{
                        $btn = '<td>-</td>';
                    }
                    return $btn;
                })
                ->rawColumns(['actions', 'payment_value'])
                ->make(true);
        }

        return view('admin.financial.index',compact('financials'));
    }

    public function store(Request $request, $user_id){
        if(trim($request->title_id) == ''){
            return response()->json('You must add a title', 403);
        }

        $title = FinancialTitle::whereId(trim($request->title_id))->first();

        if(!$title){
            return;
        }

        $user = User::whereId($user_id)->first();

        if(!$user){
            return;
        }

        $financial_user = \App\Models\Financial::where('user_id', $user_id)->get()->last();

        if($financial_user){
            if(!$financial_user->status){
                return response()->json('You cannot add until the student has paid the previous amount', 403);
            }
        }

        $financial = new \App\Models\Financial;
        $financial->user_id = $user_id;
        $financial->title_id = trim($request->title_id);
        $financial->value = $title->value;
        $financial->created_by = \Auth::user()->id;
        $financial->save();

        return response()->json('Added successfully');
    }

    public function edit(\App\Models\Financial $financial){
        $financial = $financial;

        if($financial->status == 1){
            return redirect()->back();
        }

        $titles = FinancialTitle::all();
        return view('admin.financial.create',compact(['financial', 'titles']));
    }

    public function update(Request $request, \App\Models\Financial $financial){

        $rules = [
            'title_id' => ['required'],
            'status' => ['required'],
        ];

        $messages = [
            'title_id.required'=>'You must add a title',
            'value.status'=>'You must add a status',
        ];

        $request->validate($rules,$messages);

        if($financial->status == 1){
            return;
        }

        $title = FinancialTitle::whereId(trim($request->title_id))->first();

        if(!$title){
            return;
        }

        $financial->value = $title->value;
        $financial->title_id = $title->id;
        $financial->status = trim($request->status);

        if(trim($request->status) == 1){
            $financial->type_payment = 'cash';
            $financial->payment_created_at = now();
        }else{
            $financial->type_payment = null;
            $financial->payment_created_at = null;
        }

        $financial->save();

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('financial.index')->with($notification);
    }

    public function destroy(\App\Models\Financial $financial){
        $financial->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully'
        ]);
    }
}
