<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeeEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_evaluations', function (Blueprint $table) {
            $table->foreign('evalution_jobs_id', 'FK_evalaution_job_id')->references('id')->on('evaluation_elements_jobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('company_id', 'employee_evaluations_ibfk_1')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'evaluation_user_fk	')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_evaluations', function (Blueprint $table) {
            $table->dropForeign('FK_evalaution_job_id');
            $table->dropForeign('employee_evaluations_ibfk_1');
            $table->dropForeign('evaluation_user_fk	');
        });
    }
}
