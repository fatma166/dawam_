<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_evaluations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('evaluation_user_fk');
            $table->integer('month')->nullable();
            $table->integer('year');
            $table->integer('evalution_jobs_id')->index('FK_evalaution_job_id');
            $table->json('element_degree');
            $table->integer('emp_degree')->nullable();
            $table->integer('evaluation_degree');
            $table->integer('company_id')->nullable()->index('company_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_evaluations');
    }
}
