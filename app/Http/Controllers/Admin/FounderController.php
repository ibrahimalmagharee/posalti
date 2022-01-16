<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Founder;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FounderController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request)
    {
        $founders = Founder::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Founder::query())
                //->addIndexColumn()
                ->addColumn('image', function ($founder) {
                    return '<img src="' . $founder->image_path . '" border="0" style="width: 140px; height: 130;" class="img-rounded" align="center" />';
                })->editColumn('user_id', function ($new) {
                    return $new->user->name;
                })
                ->addColumn('actions', function ($founder) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/en/admin/founder/' . $founder->id . '/edit" class="dropdown-item"><i class="ft-edit-2"></i> تعديل</a>
                        <a href="javascript:void(0)" data-id="' . $founder->id . '" class="dropdown-item deleteFounder"><i class="ft-trash-2"></i> حذف</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                ->rawColumns(['actions', 'image'])
                ->make(true);
        }
        return view('admin.founder.index', compact('founders'));
    }
    public function store(Request $request){

        $rules = [
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'name' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'image.required' => 'يجب عليك اضافة الصورة',
            'name.required' => 'يجب عليك اضافة اسم المسؤول',
            'content.required' => 'يجب عليك اضافة كلمة المسؤول',
        ];

        $request->validate($rules, $messages);

        DB::beginTransaction();
        $founder = Founder::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'content' => $request->content,
        ]);
        $string_name = RandomStringController::generateRandomString();
        $imageName = time() . '.' . $string_name;
        $request->image->move(public_path('/uploads/image_founder'), $imageName);
        $image = Image::create([
            'name' => $imageName
        ]);
        $founder->image()->save($image);
        DB::commit();
        $notification = array(
            'message' => 'تمت الاضافة  بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function edit(Founder $founder)
    {
        return view('admin.founder.create', compact('founder'));
    }
    public function create()
    {
        return view('admin.founder.create');
    }
    public function update(Request $request, Founder $founder)
    {
        DB::beginTransaction();
        $founder->name = $request->name;
        $founder->content = $request->content;
        $founder->save();
        if ($request->image) {
            Storage::disk('public_uploads')->delete('/image_founder/' . $founder->image->name);
            $founder->image->delete();
            $string_name = RandomStringController::generateRandomString();
            $imageName = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/image_founder'), $imageName);
            $image = Image::create([
                'name' => $imageName
            ]);
            $founder->image()->save($image);
        }
        DB::commit();


        $notification = array(
            'message' => 'تمت عملية التعديل بنجاح',
            'alert-type' => 'success'
        );
        return redirect()->route('founder.index')->with($notification);
    }
    public function destroy(Founder $founder)
    {
        $founder->image->delete();
        $founder->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم حذف المسؤول بنجاح'
        ]);
    }
}
