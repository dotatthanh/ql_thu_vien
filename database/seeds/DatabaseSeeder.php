<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
    }
}
