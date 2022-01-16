<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\StudenRegistrationFrom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class StudentRegisterFormController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
        $this->middleware('lang');
    }

    public function index(){
        $links = \App\Models\Social::all();
        return view('user.student-register-from', compact('links'));
    }

    public function store(Request $request){
        if(strlen(trim($request->mobile_number)) != 8){
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('content.Mobile number must contain 8 numbers only')]);
        }

        if(strlen(trim($request->father_mobile_number1)) != 8){
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('content.Your parent`s mobile number must contain 8 numbers only')]);
        }

        if(trim($request->father_mobile_number) != '' && strlen(trim($request->father_mobile_number)) != 8){
            return redirect()->back()->withInput()->withErrors(['message' => Lang::get('content.Your parent`s mobile number must contain 8 numbers only')]);
        }

        $rules = [
            'first_name' => ['required', 'string'],
            'second_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birth_date' => ['required'],
            'school_name' => ['required', 'string'],
            'educational_level' => ['required'],
            'mobile_number' => ['required'],
            'agree_to_terms' => ['required'],
            'personal_picture' => ['required'],
            'father_name1' => ['required'],
            'father_mobile_number1' => ['required'],
        ];

        $messages = [
            'first_name.required' => Lang::get('content.You must write your first name'),
            'second_name.required' => Lang::get('content.You must write your parent`s name'),
            'last_name.required' => Lang::get('content.You must write your family name'),

            'first_name.string' => Lang::get('content.You must write your real first name'),
            'second_name.string' => Lang::get('content.You must write your real parent`s name'),
            'last_name.string' => Lang::get('content.You must write your real family name'),

            'birth_date.required' => Lang::get('content.You must write your date of birth'),

            'school_name.required' => Lang::get('content.You must write the name of your school'),
            'school_name.string' => Lang::get('content.You must write the name of your real school'),

            'educational_level.required' => Lang::get('content.You must choose the current study stage'),
            'mobile_number.required' => Lang::get('content.You must write your mobile number'),
            'agree_to_terms.required' => Lang::get('content.You must agree to the terms of registration'),
            'personal_picture.required' => Lang::get('content.You must add a picture of the Qatari ID'),

            'father_name1' => Lang::get('content.You must add the name of the parent'),
            'father_mobile_number1' => Lang::get('content.You must add the mobile number of the parent'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $register_form = StudenRegistrationFrom::create([
            'user_id' =>  \Auth::user()->id,
            'first_name' => trim($request->first_name),
            'second_name' => trim($request->second_name),
            'last_name' => trim($request->last_name),
            'birth_date' => trim($request->birth_date),
            'school_name' => trim($request->school_name),
            'educational_level' => trim($request->educational_level),
            'mobile_number' => trim($request->mobile_number),
            'father_name1' => trim($request->father_name1),
            'father_mobile_number1' => trim($request->father_mobile_number1),
            'father_name' => trim($request->father_name) ? trim($request->father_name) : null,
            'father_mobile_number' => trim($request->father_mobile_number) ? trim($request->father_mobile_number) : null,
            'agree_to_terms' => trim($request->agree_to_terms) ? true : false,
        ]);

        $string_name = RandomStringController::generateRandomString();
        $image_name = time() . '.' . $string_name;
        $request->personal_picture->move(public_path('/uploads/students/images'), $image_name);

        $register_form->personal_picture = $image_name;
        $register_form->save();

        return redirect()->route('user.studentRegisterForm')->withSuccess(Lang::get('content.Your form has been sent, thank you'));
    }
}
