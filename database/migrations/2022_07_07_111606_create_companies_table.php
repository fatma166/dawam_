<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 200);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->boolean('nearest_branch')->nullable()->default(0);
            $table->integer('distance')->default(0);
            $table->boolean('fake_check')->default(0);
            $table->boolean('target_location_check')->default(0);
            $table->tinyInteger('add_client')->default(0);
            $table->integer('min_time')->default(3)->comment('min_time_work');
            $table->time('logout_time')->default('00:00:12');
            $table->tinyInteger('mac_check')->default(0);
            $table->mediumText('logo')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('country_code', 11)->default('EG');
            $table->integer('cat_id')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
