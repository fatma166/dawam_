<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('departments')->insert([

            'title' => Str::random(10),
            'branch_id' => 1,

            /* $table->string('title', 200);
            $table->integer('branch_id')->index('department_branch_fk'); */
        ]);}

}

