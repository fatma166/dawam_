<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVisitReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visit_reports', function (Blueprint $table) {
            $table->foreign('outdoor_id', 'outdoor_rep_fk')->references('id')->on('outdoors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('question_id', 'qes_rep_fk')->references('id')->on('visits_questions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'user_fk_report')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visit_reports', function (Blueprint $table) {
            $table->dropForeign('outdoor_rep_fk');
            $table->dropForeign('qes_rep_fk');
            $table->dropForeign('user_fk_report');
        });
    }
}
