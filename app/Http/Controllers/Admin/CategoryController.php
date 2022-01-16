<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller{

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->middleware('lang');
    }

    public function index(Request $request){
        $categories= Category::whereNotNull('deleted_at')->paginate(10);

        if ($request->ajax()) {
            return DataTables::of(Category::all())
                ->editColumn('user_id', function ($new) {
                    return $new->user->name;
                })
                ->addColumn('actions', function ($category) {
                    $type =  'news';
                    $btn = '<td>
                    <span class="dropdown">
                        <button id="btnSearchDrop3" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                        <span aria-labelledby="btnSearchDrop3" class="dropdown-menu mt-1 dropdown-menu-right">
                        <a href="/en/admin/category/'.$type.'/'.$category->id.'/edit" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                        <a href="javascript:void(0)" data-id="' . $category->id . '" class="dropdown-item deleteCategory"><i class="ft-trash-2"></i> Delete</a>
                        </span>
                    </span>
                    </td>';
                    return $btn;
                })
                ->rawColumns(['actions','image'])
                ->make(true);
        }

        return view('admin.category.news.index',compact('categories'));
    }

    public function create(){
        return view('admin.category.news.create');
    }

    public function store(Request $request){
        $rules = Category::$rules;

        DB::beginTransaction();

            $request->validate($rules,Category::$messages);
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            Category::create($data);

        DB::commit();
        $notification = array(
            'message' => 'Added successfully',
            'alert-type' => 'success'
        );

        $route = 'category.news.index';

        return redirect()->route($route)->with($notification);
    }

    public function edit(Request $request, Category $category){
        return view('admin.category.news.create',compact('category'));
    }

    public function update(Request $request,Category $category){

        $request->validate(Category::$rules,Category::$messages);
        DB::beginTransaction();
         $category->update($request->all());
        DB::commit();

        $notification = array(
            'message' => 'Editing completed successfully',
            'alert-type' => 'success'
        );

        $route = 'category.news.index';

        return redirect()->route($route)->with($notification);
    }

    public function destroy(Category $category){
        $category->news()->delete();
        $category->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Deleted successfully'
        ]);
    }
}
