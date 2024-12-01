<?php

namespace App\Http\Controllers;

use App\Author;
use App\Type;
use App\Author_Type;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
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
        $authors = Author::paginate(10);
        if($request->key) {
            $key = $request->key;
            $authors = Author::where('name', 'like', '%'. $request->key .'%')->paginate(10);
        }
        $data = [
            'title' => "Quản lý tác giả",
            'types' => Type::all(),
            'authors' => $authors,
            'request' => $request
        ];
        return view('admin.author', $data);
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
    public function store(AuthorRequest $request)
    {
        // Author
        $author = Author::create($request->all());

        // // Author-type
        $type_id = $request -> type;
        if($type_id != null)
        {
            for ($i=0; $i < count($type_id); $i++) { 
                $author_type = new Author_Type;
                $author_type -> author_id = $author -> id;
                $author_type -> type_id = $type_id[$i];
                $author_type -> save();
            }
        }

        return redirect()->route('authors.index')->with('notificationAdd', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorUpdateRequest $request, $id)
    {
        Author::findOrFail($id)->update([
            'name' => $request->nameupdate,
            'sex' => $request->sexupdate,
            'birthday' => $request->birthdayupdate,
            'story' => $request->storyupdate,
        ]);

        Author_Type::where('author_id', $id)->delete();
        $type_id = $request -> typeupdate;
        if($type_id != null)
        {
            for ($i=0; $i < count($type_id); $i++) { 
                $author_type = new Author_Type;
                $author_type -> author_id = $id;
                $author_type -> type_id = $type_id[$i];
                $author_type -> save();
            }
        }

        return redirect()->route('authors.index')->with('notificationUpdate', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Author::findOrFail($id)->books->count() != 0)
        {
            return redirect()->back()->with('notificationDeleteFail', 'Xóa thất bại! Cần xóa hết các sách thuộc tác giả này trước');
        }
        else
        {
            Author::findOrFail($id)->authorTypes()->delete();
            Author::findOrFail($id)->delete();
            return redirect()->back()->with('notificationDelete', 'Xóa thành công!');
        }
    }
}
