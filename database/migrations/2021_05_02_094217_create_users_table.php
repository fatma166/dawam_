<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('role_id')->nullable();
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('avatar', 255)->nullable()->default('users/default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->text('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('type')->nullable();
            $table->string('phone', 20);
            $table->string('device_token', 200)->nullable()->default('1');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->text('face_recognition')->nullable();
            $table->integer('job_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
