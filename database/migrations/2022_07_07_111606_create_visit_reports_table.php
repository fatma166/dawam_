<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_reports', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('question_id')->index('qes_rep_fk');
            $table->integer('outdoor_id')->index('outdoor_rep_fk');
            $table->mediumText('answer_value');
            $table->primary(['user_id', 'question_id', 'outdoor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_reports');
    }
}
