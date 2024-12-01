<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'code' => 'DM0001',
            'name' => 'Sách Tiếng Việt'
        ]);
        \App\Category::create([
            'code' => 'DM0002',
            'name' => 'Sách Tiếng Anh'
        ]);
        \App\Category::create([
            'code' => 'DM0003',
            'name' => 'Sách văn học nước ta'
        ]);
    }
}
