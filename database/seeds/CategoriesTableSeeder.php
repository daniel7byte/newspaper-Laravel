<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Anormalidad Academica'];

        foreach ($titles as $key => $value) {

            DB::table('categories')->insert([
                'title' => $value,
                'description' => NULL,
                'image' => NULL,
            ]);

        }
    }
}
