<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Customer;
use Exception;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $query = Customer::query();

        if ($request->has('key')) {
            $query = $query->where('name', 'like', '%'.$request->key.'%');
        }

        $customers = $query->paginate(10);

        $viewData = [
            'customers' => $customers,
            'key' => $request->key,
        ];

        return view("admin.customer.index", $viewData);
    }

    public function edit($id) {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, $id) {
        try {
            $customer = Customer::findOrFail($id);
            $data = $request->all();
            $customer->update($data);
            
            return redirect()->route('admin.customer.index')->with('alert-success','Cập nhật thông tin khách hàng thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('alert-danger', 'Cập nhật thông tin khách hàng thất bại!');
        }
    }

    public function destroy($id) {
        $customer = Customer::findOrFail($id);
        if ($customer->orders->count() == 0) {
            return redirect()->route('admin.customer.index')->with('alert-error', 'Xóa khách hàng thất bại! Khách hàng này đang có đơn hàng!');
        }
        
        $customer->delete();
        return redirect()->route('admin.customer.index')->with('alert-success', 'Xóa khách hàng thành công!');
    }

    public function logout()
    {
        auth()->guard('customer')->logout();

        return redirect()->route('pages.index');
    }

    public function create() {
        $data = [
            'title' => "Thêm khách hàng",
        ];
        return view('admin.customer.create', $data);
    }

    public function store(RegisterRequest $request) {
        $params = $request->all();
        DB::beginTransaction();

        $created = Customer::create([
            'name' => $params['name'],
            'sex' => $params['sex'],
            'birthday' => $params['birthday'],
            'phone' => $params['phone'],
            'address' => $params['address'],
            'email' => $params['email'],
            'remember_token' => Str::random(60),
            'password' => Hash::make($params['password']),
            'code' => 0
        ]);

        $created->update([
            'code' => 'KH'.$created->id
        ]);

        if ($created) {
            DB::commit();
            return redirect()->route('admin.customer.index')->with('alert-success', 'Thêm khách hàng thành công');
        } else {
            DB::rollback();
            return redirect()->back()->with('alert-error', 'Thêm khách hàng thất bại');
        }
    }
}
