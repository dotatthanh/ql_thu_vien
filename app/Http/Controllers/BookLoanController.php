<?php

namespace App\Http\Controllers;

use App\BookLoan;
use App\BookLoanDetail;
use App\Customer;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookloans = BookLoan::query();
        if ($request->search) {
            $bookloans = $bookloans->whereHas('customer', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }
        $bookloans = $bookloans->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $bookloans,
        ];

        return view('admin.book-loan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $books = Book::all();
        $data = [
            'customers' => $customers,
            'books' => $books,
        ];

        return view('admin.book-loan.create', $data);
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
            $startTime = Carbon::parse($request->from_date);
            $endTime = Carbon::parse($request->to_date);
            $daysDifference = ceil($startTime->diffInMinutes($endTime) / (24 * 60)) + 1;
            $bookLoan = BookLoan::create([
                'code' => 'PM',
                'user_id' => Auth::id(),
                'customer_id' => $request->customer_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'status' => 1,
                'total_money' => 0,
            ]);
            $bookLoan->update([
                'code' => 'PM' . str_pad($bookLoan->id, 6, '0', STR_PAD_LEFT)
            ]);

            $total_money = 0;

            foreach ($request->book_loans as $item) {
                $book = Book::findOrFail($item['book_id']);
                if ($item['quantity'] > $book->amount) {
                    return redirect()->back()->with('alert-error', 'Sản phẩm ' . $book->name . ' chỉ còn lại ' . $book->amount . ' sản phẩm!');
                }
                BookLoanDetail::create([
                    'book_loan_id' => $bookLoan->id,
                    'book_id' => $item['book_id'],
                    'quantity' => $item['quantity'],
                    'price' => $book->price,
                    'sale' => $book->sale,
                    'total_money' => $item['quantity'] * $book->price * $daysDifference,
                    'discount' => $item['quantity'] * $book->price  * $daysDifference * $book->sale / 100,
                ]);

                $book->update([
                    'amount' => $book->amount - $item['quantity'],
                ]);

                // Thành tiền 1 sản phẩm
                $total = ($item['quantity'] * $book->price * $daysDifference) - ($item['quantity'] * $book->price * $daysDifference * $book->sale / 100);
                $total_money += $total;
            }

            $bookLoan->update([
                'total_money' => $total_money,
            ]);

            DB::commit();
            return redirect()->route('book_loans.index')->with('alert-success', 'Tạo đơn mượn sách thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('alert-error', 'Tạo đơn mượn sách thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookLoan  $bookLoan
     * @return \Illuminate\Http\Response
     */
    public function show(BookLoan $bookLoan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookLoan  $bookLoan
     * @return \Illuminate\Http\Response
     */
    public function edit(BookLoan $bookLoan)
    {
        $customers = Customer::all();
        $books = Book::all();
        $data = [
            'customers' => $customers,
            'books' => $books,
            'data_edit' => $bookLoan,
        ];

        return view('admin.book-loan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookLoan  $bookLoan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookLoan $bookLoan)
    {
        DB::beginTransaction();
        try {
            $startTime = Carbon::parse($request->from_date);
            $endTime = Carbon::parse($request->to_date);
            $daysDifference = ceil($startTime->diffInMinutes($endTime) / (24 * 60)) + 1;
            $total_money = 0;

            foreach ($request->book_loans as $item) {
                $book = Book::findOrFail($item['book_id']);
                if ($item['id']) {
                    $bookLoanDetail = BookLoanDetail::find($item['id']);
                    $bookLoanDetail->update([
                        'book_id' => $item['book_id'],
                        'quantity' => $item['quantity'],
                        'price' => $book->price,
                        'sale' => $book->sale,
                        'total_money' => $item['quantity'] * $book->price * $daysDifference,
                        'discount' => $item['quantity'] * $book->price  * $daysDifference * $book->sale / 100,
                    ]);
                    $amountEdit = $book->amount + $bookLoanDetail->quantity;
                } else {
                    BookLoanDetail::create([
                        'book_loan_id' => $bookLoan->id,
                        'book_id' => $item['book_id'],
                        'quantity' => $item['quantity'],
                        'price' => $book->price,
                        'sale' => $book->sale,
                        'total_money' => $item['quantity'] * $book->price * $daysDifference,
                        'discount' => $item['quantity'] * $book->price  * $daysDifference * $book->sale / 100,
                    ]);
                    $amountEdit = $book->amount;
                }

                if ($item['quantity'] > $amountEdit) {
                    return redirect()->back()->with('alert-error', 'Sản phẩm ' . $book->name . ' chỉ còn lại ' . $book->amount . ' sản phẩm!');
                }

                $book->update([
                    'amount' => $amountEdit - $item['quantity'],
                ]);

                // Thành tiền 1 sản phẩm
                $total = ($item['quantity'] * $book->price * $daysDifference) - ($item['quantity'] * $book->price * $daysDifference * $book->sale / 100);
                $total_money += $total;
            }

            $bookLoan->update([
                'customer_id' => $request->customer_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'total_money' => $total_money,
            ]);

            DB::commit();
            return redirect()->route('book_loans.index')->with('alert-success', 'Cập nhật mượn sách thành công!');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('alert-error', 'Cập nhật mượn sách thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookLoan  $bookLoan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookLoan $bookLoan)
    {
        //
    }

    public function returnBook(BookLoan $bookLoan)
    {
        // foreach ($bookLoan->bookLoanDetails as $bookLoanDetail) {
        //     dd($bookLoanDetail);
        //     $book = $bookLoanDetail->book;
        //     $book->update([
        //         'amount' => $amountEdit - $bookLoanDetail->quantity,
        //     ]);
        // }
        $bookLoan->update(['status' => 3]);
        return redirect()->route('book_loans.index')->with('alert-success', 'Trả sách thành công!');
    }

    public function approve(BookLoan $bookLoan)
    {
        $bookLoan->update(['status' => 2]);
        return redirect()->route('book_loans.index')->with('alert-success', 'Duyệt thành công!');
    }
}
