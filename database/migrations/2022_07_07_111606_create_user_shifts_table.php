<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shifts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('shift_id')->index('usershift_shift_fk');
            $table->integer('user_id')->index('shift_user_fk');
            $table->time('time_in')->nullable();
            $table->time('time_in_max')->nullable();
            $table->time('time_in_min')->nullable();
            $table->time('time_out')->nullable();
            $table->time('time_out_max')->nullable();
            $table->time('time_out_min')->nullable();
            $table->float('break_time', 10, 0)->nullable();
            $table->date('date');
            $table->enum('active', ['on', 'off'])->default('on');
            $table->enum('over_time', ['on', 'off'])->default('on');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('company_id')->index('comp_user_shift_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shifts');
    }
}
