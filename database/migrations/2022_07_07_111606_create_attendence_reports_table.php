<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendenceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendence_reports', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_attach_fk');
            $table->date('day');
            $table->string('worktime', 11)->nullable();
            $table->string('overtime', 11)->nullable();
            $table->integer('attendance_id')->index('attendance_id_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendence_reports');
    }
}
