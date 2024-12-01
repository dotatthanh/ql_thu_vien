<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        App\User::create([
        	'name' => 'Admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt(12345678),
            'code' => 'ADMIN',
            'birthday' => '1998/04/03',
            'sex' => 'Nam',
            'phone' => 0123123123,
            'address' => 'Đồng Lý - Lý Nhân - Hà Nam',
        ]);
    }
}
