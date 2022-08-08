<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 20);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('num_days')->default(1);
            $table->enum('status', ['active', 'not_active'])->default('active');
            $table->integer('carry_forward_days')->default(0);
            $table->enum('carry_forward', ['active', 'not_active'])->default('not_active');
            $table->enum('earned_leave', ['active', 'not_active'])->default('not_active');
            $table->float('num_hours', 10, 0)->default(0);
            $table->integer('company_id')->index('company|_leave_settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
