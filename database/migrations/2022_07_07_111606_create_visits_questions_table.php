<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits_questions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('visit_type_id')->index('visit_type_quest_fk');
            $table->text('question_text');
            $table->enum('type', ['mcq', 'text', 't/f'])->default('text');
            $table->text('choose_1')->nullable();
            $table->text('choose_2')->nullable();
            $table->text('choose_3')->nullable();
            $table->text('choose_4')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits_questions');
    }
}
