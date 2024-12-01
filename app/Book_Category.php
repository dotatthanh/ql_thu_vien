<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_Category extends Model
{
    protected $table = 'book_category';
	
    protected $fillable = [
    	'book_id',
    	'category_id'
    ];

    public function book(){
    	return $this->belongsTo(Book::class);
    }
}
