<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Order;
use App\ReturnOrder;

class StatisticController extends Controller
{
    public function bookStatistic(Request $request)
    {
    	$books = Book::query();

    	if ($request->name) {
    		$books = $books->where('name', 'like', '%'.$request->name.'%');
    	}

    	if ($request->amount) {
    		if ($request->amount == 'Còn hàng') {
	    		$books = $books->where('amount', '>', 0);
    		}
    		if ($request->amount == 'Hết hàng') {
	    		$books = $books->where('amount', 0);
    		}
    	}

    	$books = $books->paginate(10);

    	$data = [
    		'books' => $books,
            'request' => $request,
    	];

    	return view('admin.statistic.book', $data);
    }
}
