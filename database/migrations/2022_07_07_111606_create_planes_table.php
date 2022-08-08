<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 250);
            $table->double('price_user');
            $table->double('price_month')->nullable();
            $table->double('price_discount')->nullable();
            $table->integer('number_users')->nullable();
            $table->text('descriptions')->nullable();
            $table->integer('company_id')->nullable();
            $table->enum('pay_type', ['month', 'year']);
            $table->string('currency', 100)->default('egp');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planes');
    }
}
