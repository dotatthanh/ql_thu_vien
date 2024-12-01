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
        $staff_sale = Role::create(['name' => 'staff_sale']);
        $staff_warehouse = Role::create(['name' => 'staff_warehouse']);
        User::find(1)->assignRole('admin');

        // Đơn Nhập hàng
        $import_order = Permission::create(['name' => 'import_order']);
        // Đơn Đặt hàng
        $order_manage = Permission::create(['name' => 'order_manage']);
        // Đơn Bán hàng
        $sale_order_manage = Permission::create(['name' => 'sale_order_manage']);
        // Đơn hàng trả lại
        $return_order_manage = Permission::create(['name' => 'return_order_manage']);
        // Thể loại
        $type_manage = Permission::create(['name' => 'type_manage']);
        // Danh mục
        $category_manage = Permission::create(['name' => 'category_manage']);
        // Tác giả
        $author_manage = Permission::create(['name' => 'author_manage']);
        // Sách
        $book_manage = Permission::create(['name' => 'book_manage']);
        // Tin tức
        $news_manage = Permission::create(['name' => 'news_manage']);
        // Nhà cung cấp
        $supplier_manage = Permission::create(['name' => 'supplier_manage']);
        // Khách hàng
        $customer_manage = Permission::create(['name' => 'customer_manage']);
        // Nhân viên
        $staff_manage = Permission::create(['name' => 'staff_manage']);
        // Vai trò
        $role_manage = Permission::create(['name' => 'role_manage']);
        // Quyền
        $permission_manage = Permission::create(['name' => 'permission_manage']);
        // Thống kê kho hàng
        $warehouse_statistic = Permission::create(['name' => 'warehouse_statistic']);
        // Thống kê hàng đã bán
        $sale_statistic = Permission::create(['name' => 'sale_statistic']);
        // Thống kê doanh thu nhân viên
        $staff_revenue_statistic = Permission::create(['name' => 'staff_revenue_statistic']);
        // Phản hồi
        $contact_statistic = Permission::create(['name' => 'contact_statistic']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($import_order);
        $admin->givePermissionTo($order_manage);
        $admin->givePermissionTo($sale_order_manage);
        $admin->givePermissionTo($return_order_manage);
        $admin->givePermissionTo($type_manage);
        $admin->givePermissionTo($category_manage);
        $admin->givePermissionTo($author_manage);
        $admin->givePermissionTo($book_manage);
        $admin->givePermissionTo($news_manage);
        $admin->givePermissionTo($supplier_manage);
        $admin->givePermissionTo($customer_manage);
        $admin->givePermissionTo($staff_manage);
        $admin->givePermissionTo($role_manage);
        $admin->givePermissionTo($permission_manage);
        $admin->givePermissionTo($warehouse_statistic);
        $admin->givePermissionTo($sale_statistic);
        $admin->givePermissionTo($staff_revenue_statistic);
        $admin->givePermissionTo($contact_statistic);

        // Set quyền cho vai trò nhân viên sale
        $staff_sale->givePermissionTo($order_manage);
        $staff_sale->givePermissionTo($sale_order_manage);
        $staff_sale->givePermissionTo($return_order_manage);
        $staff_sale->givePermissionTo($type_manage);
        $staff_sale->givePermissionTo($category_manage);
        $staff_sale->givePermissionTo($author_manage);
        $staff_sale->givePermissionTo($book_manage);
        $staff_sale->givePermissionTo($customer_manage);
        $staff_sale->givePermissionTo($warehouse_statistic);
        $staff_sale->givePermissionTo($sale_statistic);
        $staff_sale->givePermissionTo($staff_revenue_statistic);
        $staff_sale->givePermissionTo($contact_statistic);

        // Set quyền cho vai trò nhân viên kho
        $staff_warehouse->givePermissionTo($import_order);
        $staff_warehouse->givePermissionTo($type_manage);
        $staff_warehouse->givePermissionTo($category_manage);
        $staff_warehouse->givePermissionTo($author_manage);
        $staff_warehouse->givePermissionTo($book_manage);
        $staff_warehouse->givePermissionTo($supplier_manage);
        $staff_warehouse->givePermissionTo($warehouse_statistic);
        $staff_warehouse->givePermissionTo($sale_statistic);
        $staff_warehouse->givePermissionTo($staff_revenue_statistic);
    }
}
