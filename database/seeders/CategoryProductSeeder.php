<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 300; $i++) {
            DB::table('category_product')->insert([
                'category_id' => rand(1,10),
                'product_id' => rand(1,50)
            ]);
        }

    }
}
