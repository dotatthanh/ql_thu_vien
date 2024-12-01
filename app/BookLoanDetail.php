<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookLoanDetail extends Model
{
    protected $fillable = [
        'book_loan_id',
        'book_id',
        'price',
        'sale',
        'quantity',
        'discount',
        'total_money',
    ];
}
