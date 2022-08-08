<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'name' => Str::random(10),
            'phone' => Str::random(12),
            'role_id' => 1,
            'branch_id' => 1,
            'job_id' => 1,
            'department_id' => 1,
            'password' => Hash::make('password'),
        ]);

    }
}
