<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
    protected $fillable = [
        'name',
        'code',
        'img',
    	'price',
        'sale',
        'content',
        'amount',
        'size',
        'is_highlight',
        'page_number',
    ];

    public function authors(){
    	return $this->belongsToMany(Author::class);
    }

    public function suppliers(){
        return $this->belongsToMany(Supplier::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function bookCategorys(){
        return $this->hasMany(Book_Category::class);
    }

    public function bookTypes(){
        return $this->hasMany(Book_Type::class);
    }

    public function authorBooks(){
        return $this->hasMany(Author_Book::class);
    }

    public function importOrderDetails(){
        return $this->hasMany(ImportOrderDetail::class);
    }

    public function getDiscountAttribute()
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $request = resolve(Request::class);

        $result = $this->orderDetails
            ->where('created_at', '>=', $first_month)
            ->where('created_at', '<=', $end_month);

        if (isset($request->from_date)) {
            $result = $this->orderDetails->where('created_at', '>=', $request->from_date);
        }

        if (isset($request->to_date)) {
            $result = $this->orderDetails->where('created_at', '<=', $request->to_date);
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $result = $this->orderDetails->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }

        return $result->sum('discount');
    }
}
