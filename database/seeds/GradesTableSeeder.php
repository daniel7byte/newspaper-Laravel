<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Kinder', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Septimo', 'Octavo', 'Noveno', 'Decimo', 'Onceavo'];

        foreach ($titles as $key => $value) {

            DB::table('grades')->insert([
                'title' => $value,
                'description' => NULL,
                'image' => NULL,
            ]);

        }
    }
}
