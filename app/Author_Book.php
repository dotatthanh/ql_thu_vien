<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author_Book extends Model
{
    protected $table = 'author_book';
	
    protected $fillable = [
    	'author_id',
    	'book_id'
    ];

    public function book(){
    	return $this->belongsTo(Book::class);
    }
}
