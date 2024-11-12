<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')
            ->insert([
                ['category_name'=>'ألبسة'],
                ['category_name'=>'مواد غذائية'],
                ['category_name'=>'مواد صناعية'],
                ['category_name'=>'مواد طبية وتجميلية'],
                ['category_name'=>'كتب'],

            ]);
    }
}
