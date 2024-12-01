<?php

namespace App\Http\Controllers;

use App\Type;
use App\Book_Type;
use App\Author_Type;
use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
use App\Http\Requests\TypeUpdateRequest;

class TypeController extends Controller
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

        $types = Type::paginate(10);
        if($request->key) {
            $key = $request->key;
            $types = Type::where('name', 'like', '%'. $request->key .'%')->paginate(10);
        }
        $data = [
            'title' => 'Quản lý thể loại sách',
            'types' => $types,
            'request' => $request,
        ];
        return view('admin.type', $data);
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
    public function store(TypeRequest $request)
    {
        $request['code'] = 'TL';
        $type = Type::create($request->all());

        $type->update([
            'code' => 'TL'.str_pad($type->id, 4, '0', STR_PAD_LEFT)
        ]);

        return redirect()->route('types.index')->with('alert-success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypeUpdateRequest $request, $id)
    {
        Type::findOrFail($id)->update([
            'name' => $request->nameupdate,
        ]);

        return redirect()->route('types.index')->with('alert-success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function destroy($id)
    {
        if(Type::findOrFail($id)->books->count() != 0 || Type::findOrFail($id)->authors->count() != 0)
        {
            return redirect()->back()->with('alert-error', 'Xóa thất bại! Cần xóa hết các sách thuộc danh mục này trước');
        }
        else
        {
            Type::findOrFail($id)->delete();
            return redirect()->back()->with('alert-success', 'Xóa thành công!');
        }
    }
}
