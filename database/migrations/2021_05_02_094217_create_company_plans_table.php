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
            $table->integer('company_id')->index('companyplan_company_fk');
            $table->integer('plan_id')->index('companyplan_plan_fk');
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('number_user');
            $table->tinyInteger('status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->double('salary');
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
