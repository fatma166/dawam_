<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([



            'title' => Str::random(10),
            'datetime' =>'2021-04-21 11:18:02',
            'user_id' => 1,


            /*     $table->integer('id', true);
            $table->string('title', 200);
            $table->dateTime('datetime');
            $table->enum('status', ['start', 'inprogress', 'done'])->nullable();
            $table->integer('user_id')->index('task_user-fk'); */
        ]);}
        //
    }

