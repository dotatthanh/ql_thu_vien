<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Type extends Model
{
    protected $table = 'book_type';
	
    protected $fillable = [
    	'book_id',
    	'type_id'
    ];

    public function book(){
    	return $this->belongsTo(Book::class);
    }
}
