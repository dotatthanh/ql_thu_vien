<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';

    protected $fillable = [
    	'name',
    	'email',
    	'phone',
    	'address',
        'password',
        'code',
        'birthday',
        'sex',
    ];

    public function type(){
    	return $this->belongTo(Type::class);
    }
}
