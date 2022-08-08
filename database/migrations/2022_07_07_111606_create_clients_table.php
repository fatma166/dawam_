<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('name');
            $table->text('en_name')->nullable();
            $table->string('phone', 20);
            $table->text('email')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->mediumText('address');
            $table->float('lati', 10, 0)->default(0);
            $table->float('longi', 10, 0)->default(0);
            $table->integer('client_type_id')->index('customer_type_fk');
            $table->text('contact_person')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('specialization_id')->nullable()->default(1);
            $table->integer('company_id')->index('company_customer_fk');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->string('contact_phone', 20)->nullable();
            $table->text('building_info')->nullable();
            $table->integer('target')->default(0);
            $table->text('appointments')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
