<?php

use Illuminate\Database\Seeder;

class ShiftUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_shifts')->insert([

            'shift_id' =>'1',
            'user_id' => '1',

        ]);
    }
}
