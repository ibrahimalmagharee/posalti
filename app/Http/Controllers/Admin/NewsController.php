<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Category;
use App\Models\Image;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class NewsController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $news= News::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(News::query())
                ->editColumn('category_id', function ($new) {
                    return $new->category->name_en;
                })
                ->addColumn('image', function ($new) {
                    return '<img src="'. $new->image_path .'" border="0" style="width: 50px;" class="img-rounded" align="center" />';
                })
                ->addColumn('show', function ($new) {
                   return '<a href="/en/admin/ournews/'.$new->slug_en.'" data-id="' . $new->slug_en . '" class="dropdown-item"><i class="ft-eye"></i> Details</a>';

                })
                ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                 })
                ->addColumn('actions', function ($new) {
                    $btn = '<td>
                    <span class="dropdown">
                      <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                      <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/en/admin/ournews/'.$new->slug_en.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                        <a href="javascript:void(0)" data-id="' . $new->id . '" class="dropdown-item deleteNew"><i class="ft-trash-2"></i> Delete</a>
                      </span>
                    </span>
                  </td>';
                    return $btn;
                })
                ->rawColumns(['actions','image','show','user_id'])
                ->make(true);
        }

        return view('admin.news.index',compact('news'));
    }

    public function store(Request $request){

        $rules = News::$rules;
        $rules += ['image' => 'required|mimes:jpeg,jpg,png|max:10000'];

        $request->validate($rules,News::$messages);

        $separator = '-';
        $string_en = $request->title_en;

        if (is_null($string_en)) {
            return "";
        }

        $string_en = trim($string_en);
        $string_en = mb_strtolower($string_en, "UTF-8");;
        $string_en = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string_en);
        $string_en = preg_replace("/[\s-]+/", " ", $string_en);
        $string_en = preg_replace("/[\s_]/", $separator, $string_en);

        $string_ar = $request->title_ar;

        if (is_null($string_ar)) {
            return "";
        }

        $string_ar = trim($string_ar);
        $string_ar = mb_strtolower($string_ar, "UTF-8");;
        $string_ar = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string_ar);
        $string_ar = preg_replace("/[\s-]+/", " ", $string_ar);
        $string_ar = preg_replace("/[\s_]/", $separator, $string_ar);

        $data = $request->all();

        $data['slug_en'] = $string_en;
        $data['slug_ar'] = $string_ar;

        $data['user_id'] = Auth::user()->id;

        DB::beginTransaction();

            $new = News::create($data);

            $string_name = RandomStringController::generateRandomString();
            $imageName = time() . '.' . $string_name;
            $request->image->move(public_path('/uploads/image_news'), $imageName);
            $image = Image::create([
                'name' => $imageName
            ]);

            $new->image()->save($image);
        DB::commit();

        $notification = array(
            'message' => 'Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('news.index')->with($notification);
    }

    public function show($new_serial){
        $new = News::where('id', $new_serial)->orWhere('slug_en', $new_serial)->first();
        return view('admin.news.show',compact('new'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function edit($new_serial){
        $new = News::where('id', $new_serial)->orWhere('slug_en', $new_serial)->first();
        $categories = Category::all();
        return view('admin.news.create',compact('new', 'categories'));
    }

    public function update(Request $request, $new_serial){
        $new = News::where('id', $new_serial)->orWhere('slug_en', $new_serial)->first();

        $rules = [
            'title_en'=> ['required',Rule::unique('news')->ignore($new->id),],
            'title_ar'=> ['required',Rule::unique('news')->ignore($new->id),],
            'content_en'=> 'required',
            'content_ar'=> 'required',
        ];

        $request->validate($rules, News::$messages);
        $separator = '-';
        $string_en = $request->title_en;

        if (is_null($string_en)) {
            return "";
        }

        $string_en = trim($string_en);
        $string_en = mb_strtolower($string_en, "UTF-8");;
        $string_en = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string_en);
        $string_en = preg_replace("/[\s-]+/", " ", $string_en);
        $string_en = preg_replace("/[\s_]/", $separator, $string_en);

        $string_ar = $request->title_en;

        if (is_null($string_ar)) {
            return "";
        }

        $string_ar = trim($string_ar);
        $string_ar = mb_strtolower($string_ar, "UTF-8");;
        $string_ar = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string_ar);
        $string_ar = preg_replace("/[\s-]+/", " ", $string_ar);
        $string_ar = preg_replace("/[\s_]/", $separator, $string_ar);

        $data = $request->all();

        $data['slug_en'] = $string_en;
        $data['slug_ar'] = $string_ar;

        DB::beginTransaction();

            if ($request->image) {
                    Storage::disk('public_uploads')->delete('/image_news/'.$new->image->name);
                    $new->image->delete();
                    $string_name = RandomStringController::generateRandomString();
                    $imageName = time() . '.' . $string_name;
                    $request->image->move(public_path('/uploads/image_news'), $imageName);
                    $image = Image::create([
                        'name' => $imageName
                    ]);
                    $new->image()->save($image);
            }

            $new->update($data);
        DB::commit();


        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('news.index')->with($notification);
    }

    public function destroy($new_serial){
        $new = News::where('id', $new_serial)->orWhere('slug_en', $new_serial)->first();

        $new->image->delete();
        $new->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully'
        ]);
    }
}
