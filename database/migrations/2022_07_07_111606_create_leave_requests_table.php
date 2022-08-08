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
            $table->integer('user_id')->index('user_leave_fk');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('company_id')->index('company_leave_fk');
            $table->date('leave_from')->nullable();
            $table->date('leave_to')->nullable();
            $table->integer('days');
            $table->text('leave_reson');
            $table->integer('leave_type_id')->index('typ_leave_fk');
            $table->float('num_hours', 10, 0)->default(0);
            $table->text('answer')->nullable();
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
