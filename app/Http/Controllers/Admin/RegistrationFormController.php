<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistrationFormController extends Controller{

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $registrations = \App\Models\StudenRegistrationFrom::paginate(20);

        if ($request->ajax()) {
            return DataTables::of(\App\Models\StudenRegistrationFrom::all())
                ->editColumn('user_id', function ($student) {
                    return $student->student->name;
                })
                ->make(true);
        }

        return view('admin.registrationFrom.index',compact('registrations'));
    }
}
