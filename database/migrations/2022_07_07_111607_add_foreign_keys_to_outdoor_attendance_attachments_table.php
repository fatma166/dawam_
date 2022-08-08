<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOutdoorAttendanceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outdoor_attendance_attachments', function (Blueprint $table) {
            $table->foreign('outdoor_attendance_id', 'outdoor_attendance_attach_fk')->references('id')->on('outdoor_attendances')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outdoor_attendance_attachments', function (Blueprint $table) {
            $table->dropForeign('outdoor_attendance_attach_fk');
        });
    }
}
