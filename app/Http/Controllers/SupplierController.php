<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Str;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $suppliers = Supplier::paginate(10);
        if($request->key){
            $key = $request->key;
            $suppliers = Supplier::where('name', 'like', '%'. $request->key .'%')->paginate(10);
        }
        $data = [
            'title' => "Quản lý nhà cung cấp",
            'suppliers' => $suppliers,
            'request' => $request,

        ];
        return view('admin.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataEdit = [];
        return view ('admin.supplier.create', compact('dataEdit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::create([
                'code' => 'NCC',
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            $supplier->update([
                'code' => 'NCC'.str_pad($supplier->id, 4, '0', STR_PAD_LEFT)
            ]);

            DB::commit();
            return redirect()->route('suppliers.index')->with('alert-success', 'Thêm nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Thêm nhà cung cấp thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataEdit = Supplier::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin.supplier.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataEdit = Supplier::findOrFail($id);

        $data = [
            'dataEdit' => $dataEdit,
        ];

        return view ('admin.supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Supplier::findOrFail($id)->update([
                // 'code' => $request->code,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            DB::commit();
            return redirect()->route('suppliers.index')->with('alert-success', 'Cập nhật nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
            return redirect()->back()->with('alert-error', 'Cập nhật nhà cung cấp thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::destroy($id);

        return redirect()->route('suppliers.index')->with('alert-success', 'Xóa nhà cung cấp thành công!');
    }
}
