<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutdoorAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outdoor_attendances', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('outdooratt_user_fk');
            $table->integer('outdoor_id')->index('outdoor_atend_outdoor_fk');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->enum('status', ['attend', 'late', 'absent']);
            $table->tinyInteger('is_recognized');
            $table->time('time_in')->nullable();
            $table->timestamp('time_out')->nullable();
            $table->date('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outdoor_attendances');
    }
}
