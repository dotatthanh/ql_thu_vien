<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $staff_sale = Role::create(['name' => 'Nhân viên bán hàng']);
        $staff_warehouse = Role::create(['name' => 'Nhân viên kho']);
        User::find(1)->assignRole('admin');

        // Đơn Nhập hàng
        $import_order = Permission::create(['name' => 'Quản lý nhập hàng']);
        // Mượn trả sách
        $book_loan_manage = Permission::create(['name' => 'Quản lý mượn trả sách']);
        // Thể loại
        $type_manage = Permission::create(['name' => 'Quản lý thể loại']);
        // Danh mục
        $category_manage = Permission::create(['name' => 'Quản lý danh mục']);
        // Tác giả
        $author_manage = Permission::create(['name' => 'Quản lý tác giả']);
        // Sách
        $book_manage = Permission::create(['name' => 'Quản lý sách']);
        // Nhà cung cấp
        $supplier_manage = Permission::create(['name' => 'Quản lý nhà cung cấp']);
        // Khách hàng
        $customer_manage = Permission::create(['name' => 'Quản lý khách hàng']);
        // Nhân viên
        $staff_manage = Permission::create(['name' => 'Quản lý nhân viên']);
        // Vai trò
        $role_manage = Permission::create(['name' => 'Quản lý vai trò']);
        // Quyền
        $permission_manage = Permission::create(['name' => 'Quản lý quyền']);
        // Thống kê kho hàng
        $warehouse_statistic = Permission::create(['name' => 'Thống kê kho hàng']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($import_order);
        $admin->givePermissionTo($book_loan_manage);
        $admin->givePermissionTo($type_manage);
        $admin->givePermissionTo($category_manage);
        $admin->givePermissionTo($author_manage);
        $admin->givePermissionTo($book_manage);
        $admin->givePermissionTo($supplier_manage);
        $admin->givePermissionTo($customer_manage);
        $admin->givePermissionTo($staff_manage);
        $admin->givePermissionTo($role_manage);
        $admin->givePermissionTo($permission_manage);
        $admin->givePermissionTo($warehouse_statistic);

        // Set quyền cho vai trò nhân viên sale
        $staff_sale->givePermissionTo($book_loan_manage);
        $staff_sale->givePermissionTo($type_manage);
        $staff_sale->givePermissionTo($category_manage);
        $staff_sale->givePermissionTo($author_manage);
        $staff_sale->givePermissionTo($book_manage);
        $staff_sale->givePermissionTo($customer_manage);
        $staff_sale->givePermissionTo($warehouse_statistic);

        // Set quyền cho vai trò nhân viên kho
        $staff_warehouse->givePermissionTo($import_order);
        $staff_warehouse->givePermissionTo($type_manage);
        $staff_warehouse->givePermissionTo($category_manage);
        $staff_warehouse->givePermissionTo($author_manage);
        $staff_warehouse->givePermissionTo($book_manage);
        $staff_warehouse->givePermissionTo($supplier_manage);
        $staff_warehouse->givePermissionTo($warehouse_statistic);
    }
}
