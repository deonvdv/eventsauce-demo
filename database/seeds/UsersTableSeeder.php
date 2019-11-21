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
            'name' => 'Deon van der Vyver',
            'email' => 'deonvdv@gmail.com',
            'password' => bcrypt('secretxxx123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
