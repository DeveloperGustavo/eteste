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
            'name'                  => 'Gustavo',
            'email'                 => 'gtbarbosa@live.com',
            'password'              => bcrypt('123456'),
            'function_description'  => 'Headhunter',
            'login'                 => 'gtbarbosa',
            'birthday'              => '1995-12-31',
            'salary'                => 1000.00,
            'is_admin'              => 1,
            'created_at'            => now(),
            'updated_at'            => now()
        ]);
    }
}
