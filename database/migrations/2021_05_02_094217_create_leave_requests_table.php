<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('leave_time')->useCurrent();
            $table->enum('status', ['pending', 'accepted', 'refused'])->default('pending');
            $table->integer('user_id')->index('leave_user_fk');
            $table->integer('branch_id')->index('leave_branch_fk');
            $table->integer('department_id')->index('leave_department_fk');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
