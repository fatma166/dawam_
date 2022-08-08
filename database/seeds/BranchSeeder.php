<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('branches')->insert([

            'title' => Str::random(10),
            'longi' => Str::random(12),
            'lati' => Str::random(12),
            'adress' => Str::random(12),
            'company_id' => 1,

        ]);}
/*
     $table->string('title', 200);
            $table->mediumText('longi');
            $table->mediumText('lati');
            $table->text('adress');
            $table->integer('company_id')->index('branch_company_fk');
 */

    }

