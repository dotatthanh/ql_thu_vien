<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
    	'name',
    	'sex',
    	'birthday',
    	'story'
    ];

    public function books(){
    	return $this->belongsToMany(Book::class);
    }

    public function types(){
    	return $this->belongsToMany(Type::class);
    }

    public function authorTypes(){
        return $this->hasMany(Author_Type::class);
    }
}
