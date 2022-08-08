<?php

use Illuminate\Database\Seeder;

class OutdoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('outdoors')->insert([

            'time_from' => '2021-04-21 11:18:02',
            'time_to' =>'2021-04-21 11:18:02',
            'lati' => Str::random(12),
            'longi' => Str::random(12),
            'adress' => Str::random(12),
            'user_id' => 1,

        ]);}

        /*
            $table->integer('user_id')->index('outdoor_user_fk');
            $table->timestamp('time_from');
            $table->timestamp('time_to')->nullable();
            $table->text('lati');
            $table->text('longi');
            $table->text('adress');
        */

    }

