<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Central', 'Simon Bolivar'];

        foreach ($titles as $key => $value) {

            DB::table('institutions')->insert([
                'title' => $value,
                'description' => NULL,
                'image' => NULL,
            ]);

        }
    }
}
