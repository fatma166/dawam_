<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('branch_id', 'branch_user_fk')->references('id')->on('branches')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('company_id', 'user_company_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('department_id', 'user_department_fk')->references('id')->on('departments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('job_id', 'user_job_fk')->references('id')->on('jobs')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('role_id', 'user_role_fk')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('branch_user_fk');
            $table->dropForeign('user_company_fk');
            $table->dropForeign('user_department_fk');
            $table->dropForeign('user_job_fk');
            $table->dropForeign('user_role_fk');
        });
    }
}
