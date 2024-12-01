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
        User::find(1)->assignRole('admin');

        // Phản hồi
        $contact_statistic = Permission::create(['name' => 'contact_statistic']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($contact_statistic);

        // Set quyền cho vai trò nhân viên sale
        $staff_sale->givePermissionTo($contact_statistic);
    }
}
