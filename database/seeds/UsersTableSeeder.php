<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Jose Daniel',
            'last_name' => 'Posso Garcia',
            'active' => 1,
            'role' => 'ADMIN',
            'grade' => 'Decimo',
            'institution_ref' => 'Central',
            'image' => NULL,
            'identification_document' => 1193373386,
            'telephone' => 3194995422,
            'address' => 'Calle 11 # 13 - 31 Belén, La Unión, Valle del Cauca, Colombia',
            'email' => 'daniel7byte@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
