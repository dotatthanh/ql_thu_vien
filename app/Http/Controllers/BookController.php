<?php

namespace App\Http\Controllers;

use App\Book;
use App\Supplier;
use App\Type;
use App\Category;
use App\Author;
use App\Author_Book;
use App\Book_Type;
use App\Book_Category;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
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
        $books = Book::paginate(10);

        if($request->key) {
            $key = $request->key;
            $books = Book::where('name', 'like', '%'. $request->key .'%')->paginate(10);
        }

        $data = [
            'title' => "Quản lý sách",
            'books' => $books,
            'suppliers' => Supplier::all(),
            'authors' => Author::all(),
            'types' => Type::all(),
            'categories' => Category::all(),
            'request' => $request
        ];
        return view('admin.book', $data);
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
    public function store(BookRequest $request)
    {
        $data = $request->all();
        
        $name = '';
        foreach ($data['category'] as $category_id) {
            $category = Category::find($category_id);

            $nameParts = explode(' ', trim($category->name));
            foreach ($nameParts as $value) {
                $name .= substr($value, 0, 1);
            }
        }
        $data['code'] = strtoupper($name);

        if (!isset($data['is_highlight'])) {
            $data['is_highlight'] = 0;
        }

        if (is_null($data['sale'])) {
            $data['sale'] = 0;
        }
        // xử lý img
        if ($request->hasFile('img')) {
            $file1Extension = $request->file('img')
                ->getClientOriginalExtension();
            $fileName1 = uniqid() . '.' . $file1Extension;
            $request->file('img')
                ->storeAs('public', $fileName1);
            $data['img'] = $fileName1;
        }

        // Book
        $book = Book::create($data);

        // Book_type
        $type_id = $request->type;
        if($type_id != null)
        {
            for ($i=0; $i < count($type_id); $i++) { 
                $book_type = new Book_Type;
                $book_type->book_id = $book->id;
                $book_type->type_id = $type_id[$i];
                $book_type->save();
            }
        }

        // Book_category
        $category_id = $request->category;
        if($category_id != null)
        {
            for ($i=0; $i < count($category_id); $i++) { 
                $book_category = new Book_Category;
                $book_category->book_id = $book->id;
                $book_category->category_id = $category_id[$i];
                $book_category->save();
            }
        }

        // Author_Book
        $author_id = $request->author_id;
        if($author_id != null)
        {
            for ($i=0; $i < count($author_id); $i++) { 
                $author_book = new Author_Book;
                $author_book->author_id = $author_id[$i];
                $author_book->book_id = $book->id;
                $author_book->save();
            }
        }

        $book->update([
            'code' => strtoupper($name).str_pad($book->id, 4, '0', STR_PAD_LEFT)
        ]);

        return redirect()->back()->with('alert-success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        if (is_null($request->sale)) {
            $request->sale = 0;
        }

        if (!isset($request->is_highlight)) {
            $request->is_highlight = 0;
        }
        
        if (isset($request->img)) {
            $data = [
                'supplier_id' => $request->supplier,
                'name' => $request->name,
                'img' => $request->img,
                'price' => $request->price,
                'sale' => $request->sale,
                'content' => $request->content,
                'size' => $request->size,
                'page_number' => $request->page_number,
                'is_highlight' => $request->is_highlight,
            ];
        }
        else {
            $data = [
                'supplier_id' => $request->supplier,
                'name' => $request->name,
                'price' => $request->price,
                'sale' => $request->sale,
                'content' => $request->content,
                'size' => $request->size,
                'page_number' => $request->page_number,
                'is_highlight' => $request->is_highlight,
            ];
        }

        // xử lý img
        if ($request->hasFile('img')) {
            $file1Extension = $request->file('img')
                ->getClientOriginalExtension();
            $fileName1 = uniqid() . '.' . $file1Extension;
            $request->file('img')
                ->storeAs('public', $fileName1);
            $data['img'] = $fileName1;
        }

        Book::findOrFail($id)->update($data);


        // Book_type
        Book_Type::where('book_id', $id)->delete();
        $type_id = $request->type;
        if($type_id != null)
        {
            for ($i=0; $i < count($type_id); $i++) { 
                $book_type = new Book_Type;
                $book_type->book_id = $id;
                $book_type->type_id = $type_id[$i];
                $book_type->save();
            }
        }

        // Book_category
        Book_Category::where('book_id', $id)->delete();
        $category_id = $request->category;
        if($category_id != null)
        {
            for ($i=0; $i < count($category_id); $i++) { 
                $book_category = new Book_Category;
                $book_category->book_id = $id;
                $book_category->category_id = $category_id[$i];
                $book_category->save();
            }
        }

        // Author_Book
        Author_Book::where('book_id', $id)->delete();
        $author_id = $request->author;
        if($author_id != null)
        {
            for ($i=0; $i < count($author_id); $i++) { 
                $author_book = new Author_Book;
                $author_book->book_id = $id;
                $author_book->author_id = $author_id[$i];
                $author_book->save();
            }
        }
        
        return redirect()->route('books.index')->with('alert-success', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->bookCategorys()->delete();
        Book::findOrFail($id)->bookTypes()->delete();
        Book::findOrFail($id)->authorBooks()->delete();
        Book::findOrFail($id)->delete();
        
        return redirect()->back()->with('alert-success', 'Xóa thành công!');
    }
}
