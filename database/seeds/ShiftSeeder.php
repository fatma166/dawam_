<?php

use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shifts')->insert([

            'time_from' =>'14:02:34',
            'time_to' => '14:02:34',
            'description' => 'day',

        ]);

        /*    $table->integer('id', true);
            $table->time('time_from');
            $table->time('time_to');
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent(); */
    }
}
