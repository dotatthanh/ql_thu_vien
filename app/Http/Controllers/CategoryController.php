<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $categories = Category::paginate(10);
        if($request->key){
            $key = $request->key;
            $categories = Category::where('name', 'like', '%'. $request->key .'%')->paginate(10);
        }

        $category_parents = Category::where('parent_id', NULL)->get();

        $data = [
            'title' => "Quản lý danh mục sách",
            'category_parents' => $category_parents,
            'categories' => $categories,
            'request' => $request,

        ];
        return view('admin.category', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request['code'] = 'DM';
        $category = Category::create($request->all());

        $category->update([
            'code' => 'DM'.str_pad($category->id, 4, '0', STR_PAD_LEFT)
        ]);

        return redirect()->route('categorys.index')->with('alert-success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            // check nếu có danh mục con
            if (Category::where('parent_id', $id)->count() > 0) {
                return redirect()->route('categorys.index')->with('alert-error', 'Sửa thất bại! Danh mục '.$category->name.' đang là danh mục cha!');
            }

            $category->update([
                'name' => $request->nameupdate,
                'parent_id' => $request->parent_id,
            ]);

            DB::commit();
            return redirect()->route('categorys.index')->with('alert-success', 'Sửa thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Có lỗi xảy ra! Xóa danh mục thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            if ($id <= 3) {
                return redirect()->back()->with('alert-error', 'Xóa danh mục thất bại! Danh mục này đang hiển thị trên website!');
            }
            elseif (Category::findOrFail($id)->books->count() != 0)
            {
                return redirect()->back()->with('alert-error', 'Xóa danh mục thất bại! Cần xóa hết các sách thuộc danh mục này trước');
            }
            
            Category::findOrFail($id)->delete();
            Category::where('parent_id', $id)->delete();

            DB::commit();
            return redirect()->back()->with('alert-success', 'Xóa danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Có lỗi xảy ra! Xóa danh mục thất bại!');
        }
    }
}
