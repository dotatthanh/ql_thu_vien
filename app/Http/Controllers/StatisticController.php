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

    public function bookSoldStatistic(Request $request)
    {
        // $books = Book::query();

        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $books = Book::whereHas('orderDetails', function ($query) use ($first_month, $end_month, $request) {
            $query->where('created_at', '>=', $first_month)->where('created_at', '<=', $end_month);
        })->orWhereHas('returnOrderDetails', function ($query) use ($first_month, $end_month, $request) {
            $query->where('created_at', '>=', $first_month)->where('created_at', '<=', $end_month);
        });

        if (isset($request->from_date)) {
            $books = Book::whereHas('orderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '>=', $request->from_date);
            })->orWhereHas('returnOrderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '>=', $request->from_date);
            });
        }

        if (isset($request->to_date)) {
            $books = Book::whereHas('orderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '<=', $request->to_date);
            })->orWhereHas('returnOrderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '<=', $request->to_date);
            });
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $books = Book::whereHas('orderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
            })->orWhereHas('returnOrderDetails', function ($query) use ($first_month, $end_month, $request) {
                $query->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
            });
        }

        if (isset($request->name)) {
            $books = $books->where('name', 'like', '%'.$request->name.'%');
        }

        $books = $books->paginate(10);

        $data = [
            'books' => $books,
            'request' => $request,
        ];

        return view('admin.statistic.book-sold', $data);
    }

    public function staffRevenue(Request $request)
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');
        $users = User::query();

        if ($request->name) {
            $users = $users->where('name', 'like', '%'.$request->name.'%');
        }

        $users = $users->paginate(10);

        $revenue = Order::where('status', 4)->where('created_at', '>=', $first_month)->where('created_at', '<=', $end_month)->sum('total_money') - ReturnOrder::where('status', 1)->where('created_at', '>=', $first_month)->where('created_at', '<=', $end_month)->sum('total_money');

        if (isset($request->from_date)) {
            $revenue = Order::where('status', 4)->where('created_at', '>=', $request->from_date)->sum('total_money') - ReturnOrder::where('status', 1)->where('created_at', '>=', $request->from_date)->sum('total_money');
        }

        if (isset($request->to_date)) {
            $revenue = Order::where('status', 4)->where('created_at', '<=', $request->to_date)->sum('total_money') - ReturnOrder::where('status', 1)->where('created_at', '<=', $request->to_date)->sum('total_money');
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $revenue = Order::where('status', 4)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date)->sum('total_money') - ReturnOrder::where('status', 1)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date)->sum('total_money');
        }

        $data = [
            'users' => $users,
            'request' => $request,
            'revenue' => $revenue,
        ];

        return view('admin.statistic.staff_revenue', $data);
    }
}
