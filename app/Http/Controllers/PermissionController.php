<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request) {
        $query = Permission::query();

        if ($request->has('key')) {
            $query = $query->where('name', 'like', '%'.$request->key.'%');
        }

        $permissions = $query->paginate(10);

        $viewData = [
            'permissions' => $permissions,
            'key' => $request->key,
        ];

        return view("admin.permission.index", $viewData);
    }

    public function edit($id) {
        $permission = Permission::findOrFail($id);

        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id) {
        try {
            $permission = Permission::findOrFail($id);
            $this->validate($request, [
                'name'=>'required|max:40',
            ]);
            $input = $request->all();
            $permission->fill($input)->save();

            return redirect()->route('admin.permission.index')->with('alert-success', 'Cập nhật quyền hạn thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('alert-danger', 'Cập nhật quyền thất bại!');
        }
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('admin.permission.index')->with('alert-error', 'Không thể xóa quyền này');
        }
        $permission->delete();
        return redirect()->route('admin.permission.index')->with('alert-success', 'Xóa quyền thành công!');
    }
}
