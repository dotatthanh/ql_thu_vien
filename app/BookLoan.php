<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookLoan extends Model
{
    protected $fillable= [
        'customer_id',
        'user_id',
        'from_date',
        'to_date',
        'total_money',
        'status',
    ];

    public function customer(){
    	return $this->belongsTo(Customer::class);
    }
    
    public function bookLoanDetails(){
    	return $this->hasMany(BookLoanDetail::class);
    }
}
