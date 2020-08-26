<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         insert sample user as the system admin
        DB::table('users')->insert([
            'name' => 'Braulio',
            'email' => 'bfmg.08@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'position_title' => 'Super Administrador',
            'company_id' => 2,
            'is_admin' => 0,
            'is_super_admin' => 1,
            'is_active' => 1
        ]);
    }
}
