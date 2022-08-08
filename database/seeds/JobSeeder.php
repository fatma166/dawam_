<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('jobs')->insert([

            'job_title' => Str::random(10),


            /* $table->string('title', 200);
            $table->integer('branch_id')->index('department_branch_fk'); */
        ]);}

}

