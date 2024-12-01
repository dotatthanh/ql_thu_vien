<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categorys';
    protected $fillable = [
    	'code',
    	'name',
    	'parent_id',
    ];

    public function books(){
    	return $this->belongsToMany(Book::class);
    }

    public function getCategoryParentAttribute(){
    	if ($this->parent_id) {
    		return Category::findOrFail($this->parent_id)->name;
    	}
    }

    public function getSubcategoryAttribute(){
    	return Category::where('parent_id', $this->id)->get();
    }
}
