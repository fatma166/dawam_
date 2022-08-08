<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_attachments', function (Blueprint $table) {
            $table->integer('attendance_id');
            $table->text('avatar')->nullable();
            $table->mediumText('lati');
            $table->mediumText('longi');
            $table->boolean('in_target')->default(0);
            $table->boolean('is_fake')->default(0);
            $table->enum('type', ['in', 'out'])->default('in');
            $table->text('address');
            $table->primary(['attendance_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_attachments');
    }
}
