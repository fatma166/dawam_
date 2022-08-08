<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAttendanceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_attachments', function (Blueprint $table) {
            $table->foreign('attendance_id', 'attendance_attach_fk')->references('id')->on('attendances')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_attachments', function (Blueprint $table) {
            $table->dropForeign('attendance_attach_fk');
        });
    }
}
