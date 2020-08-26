<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // inserting document types
        foreach (config('seed_data.document_types') as $value) {

            DB::table('document_type')->insert([
                'name' => $value
            ]);
        }

        // insert task status
        foreach (config('seed_data.task_statuses') as $value) {

            DB::table('task_status')->insert([
                'name' => $value
            ]);
        }

        // insert task types
        foreach (config('seed_data.task_types') as $value) {

            DB::table('task_type')->insert([
                'name' => $value
            ]);
        }

        // insert contact status
        foreach (config('seed_data.contact_status') as $value) {

            DB::table('contact_status')->insert([
                'name' => $value
            ]);
        }

        // insert the system main email into settings table
        foreach (config('seed_data.settings') as $key => $value) {
            DB::table('setting')->insert([
                'setting_key' => $key,
                'setting_value' => $value
            ]);
        }

        DB::table('companies')->insert([
            'name' => 'Sin Asignar',
            'email' => 'Testing',
            'is_active' => 1
        ]);

        // insert sample user as the system admin
        DB::table('companies')->insert([
            'name' => 'CRM',
            'email' => 'superadmin@crm.com',
            'is_active' => 1
        ]);


        // insert sample user as the system admin
        DB::table('users')->insert([
            'name' => 'Gamez',
            'email' => 'veyriko@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'position_title' => 'Super Administrador',
            'company_id' => 2,
            'is_admin' => 1,
            'is_super_admin' => 1,
            'is_active' => 1
        ]);

        // insert the initial permissions
        $permissions = [];
        foreach (config('seed_data.permissions') as $value) {
            $permissions[] = Permission::create(['name' => $value]);
        }
    }
}
