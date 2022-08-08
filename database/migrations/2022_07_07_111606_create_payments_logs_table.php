<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_logs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('paid');
            $table->integer('depit')->nullable();
            $table->integer('credit')->nullable();
            $table->string('pay_method', 200);
            $table->integer('users_number');
            $table->date('period_from');
            $table->date('period_to');
            $table->tinyInteger('status')->default(0);
            $table->integer('company_id');
            $table->integer('company_plan_id');
            $table->integer('representative_id')->nullable();
            $table->dateTime('created_at')->useCurrent();
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
        Schema::dropIfExists('payments_logs');
    }
}
