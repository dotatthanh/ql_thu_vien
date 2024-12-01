<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author_Type extends Model
{
    protected $table = 'author_type';
	
    protected $fillable = [
    	'author_id',
    	'type_id'
    ];

    public function author(){
    	return $this->belongsTo(Author::class);
    }
}
