<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'T-shirt'
        ]);
        DB::table('categories')->insert([
            'name' => 'Shirt'
        ]);
        DB::table('categories')->insert([
            'name' => 'Pant'
        ]);
        DB::table('categories')->insert([
            'name' => 'long sleeve',
            'category_id' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => 'short sleeve',
            'category_id' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => 'deniem shirt',
            'category_id' => 2,
        ]);
        DB::table('categories')->insert([
            'name' => 'half sleeve',
            'category_id' => 2,
        ]);
        DB::table('categories')->insert([
            'name' => 'Jeans',
            'category_id' => 3,
        ]);
        DB::table('categories')->insert([
            'name' => 'cargo',
            'category_id' => 3,
        ]);
    }
}
