<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'code',
        'birthday',
        'sex',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders () {
        return $this->hasMany(Order::class);
    }

    public function returnOrders () {
        return $this->hasMany(ReturnOrder::class);
    }

    public function getTotalSalesOrderAmountAttribute()
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $request = resolve(Request::class);

        $result = $this->orders->where('status', 4)
            ->where('created_at', '>=', $first_month)
            ->where('created_at', '<=', $end_month);

        if (isset($request->from_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '>=', $request->from_date);
        }

        if (isset($request->to_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '<=', $request->to_date);
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }

        return $result->sum('total_money');
    }

    public function getTotalSalesOrderAttribute()
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $request = resolve(Request::class);

        $result = $this->orders->where('status', 4)
            ->where('created_at', '>=', $first_month)
            ->where('created_at', '<=', $end_month);

        if (isset($request->from_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '>=', $request->from_date);
        }

        if (isset($request->to_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '<=', $request->to_date);
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $result = $this->orders->where('status', 4)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }

        return $result->count();
    }

    public function getTotalReturnOrderAttribute()
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $request = resolve(Request::class);

        $result = $this->returnOrders
            ->where('created_at', '>=', $first_month)
            ->where('created_at', '<=', $end_month);

        if (isset($request->from_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '>=', $request->from_date);
        }

        if (isset($request->to_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '<=', $request->to_date);
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }

        return $result->count();
    }

    public function getTotalReturnOrderAmountAttribute()
    {
        $first_month = date('Y-m-01 00:00:00');
        $end_month = date('Y-m-t 23:59:59');

        $request = resolve(Request::class);

        $result = $this->returnOrders
            ->where('created_at', '>=', $first_month)
            ->where('created_at', '<=', $end_month);

        if (isset($request->from_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '>=', $request->from_date);
        }

        if (isset($request->to_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '<=', $request->to_date);
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $result = $this->returnOrders->where('status', 1)->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }

        return $result->sum('total_money');
    }
}
