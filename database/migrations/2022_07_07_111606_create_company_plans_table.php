<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_plans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->index('company_p_fk');
            $table->integer('plan_id')->index('plan_fk');
            $table->date('date_from');
            $table->date('date_to')->nullable();
            $table->integer('number_user');
            $table->tinyInteger('status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->double('salary');
            $table->integer('duration');
            $table->integer('paid')->default(0);
            $table->integer('transaction_id')->nullable();
            $table->string('transaction_status', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_plans');
    }
}
