<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationElementsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_elements_jobs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('job_id')->index('Fk_job_id');
            $table->text('element_degree')->nullable();
            $table->integer('company_id')->index('Fk_company_id');
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
        Schema::dropIfExists('evaluation_elements_jobs');
    }
}
