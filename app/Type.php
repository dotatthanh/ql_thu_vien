<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
    	'name',
    	'code',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
    
    public function authors(){
    	return $this->belongsToMany(Author::class);
    }
}
