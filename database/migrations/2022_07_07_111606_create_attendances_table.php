<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_att_fk');
            $table->integer('shift_id')->index('shift_att_fk');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->enum('status', ['attend', 'absent', 'Attendance_discount'])->default('attend');
            $table->integer('branch_id')->index('att_branch_fk');
            $table->tinyInteger('is_holiday');
            $table->timestamp('created_at')->useCurrent();
            $table->tinyInteger('is_recognized')->nullable();
            $table->integer('company_id')->index('att_company_fk');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->text('attendances_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
