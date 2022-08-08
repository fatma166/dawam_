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
            $table->integer('role_id')->nullable()->index('user_role_fk');
            $table->string('name', 255);
            $table->string('email', 255)->nullable()->unique('email');
            $table->boolean('email_isverified')->nullable()->default(0);
            $table->text('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->rememberToken();
            $table->text('settings')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->softDeletes()->useCurrent();
            $table->tinyInteger('type')->nullable();
            $table->string('phone', 20);
            $table->boolean('phone_isverified')->nullable()->default(0);
            $table->text('MAC_address')->nullable();
            $table->string('device_token', 200)->nullable()->default('1');
            $table->integer('branch_id')->nullable()->index('branch_user_fk');
            $table->integer('department_id')->nullable()->index('user_department_fk');
            $table->integer('company_id')->nullable()->index('user_company_fk');
            $table->text('face_recognition')->nullable();
            $table->integer('job_id')->nullable()->index('user_job_fk');
            $table->dateTime('join_date')->useCurrent();
            $table->boolean('active')->default(1);
            $table->boolean('bassma')->default(1);
            $table->json('device_info')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->integer('shift_id')->nullable();
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
