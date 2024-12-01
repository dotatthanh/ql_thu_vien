<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Supplier::create([
            'code' => 'NCC0001',
            'name' => 'Nhà xuất bản Kim Đồng',
            'slug' => 'nha-xuat-ban-kim-dong',
	        'email' => 'nxbkimdong@gmail.com',
	        'address' => 'Hà Nội',
	        'phone' => '0123456789',
        ]);
        \App\Supplier::create([
            'code' => 'NCC0002',
            'name' => 'Nhà xuất bản Việt Nam',
            'slug' => 'nha-xuat-ban-viet-nam',
            'email' => 'nxbvn@gmail.com',
            'address' => 'Hà Nội',
            'phone' => '0123456788',
        ]);
    }
}
