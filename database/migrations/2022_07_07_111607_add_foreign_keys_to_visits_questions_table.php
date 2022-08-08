<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVisitsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits_questions', function (Blueprint $table) {
            $table->foreign('visit_type_id', 'visit_type_quest_fk')->references('id')->on('visits_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits_questions', function (Blueprint $table) {
            $table->dropForeign('visit_type_quest_fk');
        });
    }
}
