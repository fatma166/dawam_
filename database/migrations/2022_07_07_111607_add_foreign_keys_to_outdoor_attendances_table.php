<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOutdoorAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outdoor_attendances', function (Blueprint $table) {
            $table->foreign('outdoor_id', 'outdoor_atend_outdoor_fk')->references('id')->on('outdoors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'outdooratt_user_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outdoor_attendances', function (Blueprint $table) {
            $table->dropForeign('outdoor_atend_outdoor_fk');
            $table->dropForeign('outdooratt_user_fk');
        });
    }
}
