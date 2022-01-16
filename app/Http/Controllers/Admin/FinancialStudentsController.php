<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use App\Models\FinancialTitle;
use App\Models\User;
use Illuminate\Http\Request;

class FinancialStudentsController extends Controller{

    public function create($title_id){
        $title = FinancialTitle::whereId($title_id)->first();

        $eloquent = User::where('is_admin', 0);

        // $eloquent->whereHas('financials', function($query) use ($title_id){
        //     $query->where('title_id', $title_id);
        //     $query->where('status', 1);
        // });
        // $eloquent->where(function($query) use ($title_id){

        //     $query->whereHas('financials', function($query) use ($title_id){
        //         $query->where('title_id', $title_id);
        //         $query->where('status', 1);
        //     });

        //     // $query->orDoesntHave('financials');
        // });


        $students = $eloquent->get();

        return view('admin.financialStudents.create', compact(['title' ,'students']));
    }

    public function store(Request $request, $title_id){
        $student_ids_checked = json_decode($request->student_ids_checked);

        $title = FinancialTitle::whereId($title_id)->first();

        if(!$title){
            return response()->json('Error, Title not found', 403);
        }

        \DB::beginTransaction();
        try {

            foreach($student_ids_checked as $student_id){
                $student = User::whereId($student_id)->first();

                if(!$student->last_financial() || $student->last_financial()->status){

                    $financial = new Financial;
                    $financial->user_id = $student->id;
                    $financial->title_id = $title->id;
                    $financial->value = $title->value;
                    $financial->created_by = \Auth::user()->id;

                    $financial->save();
                }
            }

            \DB::commit();
            return response(['message' => 'Operation accomplished successfully']);
        } catch (\Exception $e) {
            \DB::rollback();
            return response(['message' => $e->getMessage()], 403);
        }

        return response(['message' => 'fail'], 403);
    }
}
