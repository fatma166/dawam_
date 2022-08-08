<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([

            'name' => Str::random(10),
            'display_name' => Str::random(12),
          
        ]);}
}

