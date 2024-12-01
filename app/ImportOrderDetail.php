<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportOrderDetail extends Model
{
    protected $fillable = [
    	'import_order_id',
    	'book_id',
    	'amount',
    	'price',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class);
    }
}
