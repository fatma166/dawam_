<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEvaluationElementsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluation_elements_jobs', function (Blueprint $table) {
            $table->foreign('job_id', 'Fk_job_id')->references('id')->on('jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_elements_jobs', function (Blueprint $table) {
            $table->dropForeign('Fk_job_id');
        });
    }
}
