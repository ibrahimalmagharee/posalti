<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialTitle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FinancialTitleController extends Controller{

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $titles = \App\Models\FinancialTitle::paginate(20);

        if ($request->ajax()) {
            return DataTables::of(\App\Models\FinancialTitle::all())
            ->addColumn('actions', function ($title) {
                $btn = '<td>
                            <span class="dropdown">
                                <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                                    <a href="/en/admin/financial/titles/'.$title->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                                    <a href="/en/admin/financial/titles/'.$title->id.'/students/create" class="dropdown-item">Add Students</a>
                                </span>
                            </span>
                        </td>';
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.FinancialTitle.index',compact('titles'));
    }

    public function create(){
        return view('admin.FinancialTitle.create');
    }

    public function store(Request $request){
        $rules = [
            'title_en' => ['required', 'string'],
            'title_ar' => ['required', 'string'],
            'value' => ['required', 'numeric'],
        ];

        $messages = [
            'title_en.required'=>'You must add the Title as English',
            'title_ar.required'=>'You must add the Title as Arabic',
            'value.required'=>'You must add Value',
        ];

        $request->validate($rules,$messages);

        if($request->password != $request->password_confirm){
            return redirect()->back()->withErrors(['message' => 'Password does not match']);
        }

        $data = $request->all();

        FinancialTitle::create($data);
        $notification = array(
            'message' => 'Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('financial_titles.index')->with($notification);
    }

    public function edit(FinancialTitle $title){
        $title = $title;
        return view('admin.FinancialTitle.create',compact('title'));
    }

    public function update(Request $request, FinancialTitle $title){
        $rules = [
            'title_en' => ['required', 'string'],
            'title_ar' => ['required', 'string'],
            'value' => ['required', 'numeric'],
        ];

        $messages = [
            'title_en.required'=>'You must add the Title as English',
            'title_ar.required'=>'You must add the Title as Arabic',
            'value.required'=>'You must add Value',
        ];

        $request->validate($rules,$messages);

        $data = $request->all();

        $title->update($data);

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('financial_titles.index')->with($notification);
    }
}
