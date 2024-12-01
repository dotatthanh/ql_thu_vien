<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportOrder;
use App\ImportOrderDetail;
use App\Book;
use App\Supplier;
use App\Author;
use App\Type;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $warehouses = ImportOrder::paginate(10);

        if ($request->code) {
            $warehouses = ImportOrder::where('code', $request->code)->paginate(10);
        }

        $data = [
            'warehouses' => $warehouses,
            'request' => $request,
        ]; 

        return view('admin.warehouse.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $suppliers = Supplier::all();

        $data = [
            'books' => $books,
            'suppliers' => $suppliers,
            'authors' => Author::all(),
            'types' => Type::all(),
            'categories' => Category::all(),
        ]; 

        return view('admin.warehouse.import_book', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // tạo đơn nhập hàng
            $import_order = ImportOrder::create([
                'code' => 'PN',
                'user_id' => Auth::id(),
                'supplier_id' => $request->supplier_id,
                'total_money' => 0,
            ]);

            $import_order->update([
                'code' => 'PN'.str_pad($import_order->id, 6, '0', STR_PAD_LEFT)
            ]);

            $total_money = 0;
            // tạo chi tiết đơn nhập hàng
            foreach ($request->book_id as $key => $book_id) {
                ImportOrderDetail::create([
                    'import_order_id' => $import_order->id,
                    'book_id' => $book_id,
                    'amount' => $request->amount[$key],
                    'price' => $request->price[$key],
                ]);

                $book = Book::findOrFail($book_id);
                $book->update([
                    'amount' => $book->amount + $request->amount[$key],
                ]);

                $total = $request->amount[$key] * $request->price[$key];
                $total_money += $total;
            }

            $import_order->update([
                'total_money' => $total_money
            ]);

            DB::commit();
            return redirect()->route('warehouses.index')->with('alert-success', 'Nhập hàng thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Nhập hàng thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $import_order_details = ImportOrderDetail::where('import_order_id', $id)->paginate(10);

        $data = [
            'import_order_details' => $import_order_details
        ];

        return view('admin.warehouse.import_order_detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
