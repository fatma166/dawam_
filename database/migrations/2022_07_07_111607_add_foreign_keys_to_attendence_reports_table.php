<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAttendenceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendence_reports', function (Blueprint $table) {
            $table->foreign('attendance_id', 'attendance_id_fk')->references('id')->on('attendances')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('user_id', 'user_attach_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendence_reports', function (Blueprint $table) {
            $table->dropForeign('attendance_id_fk');
            $table->dropForeign('user_attach_fk');
        });
    }
}
