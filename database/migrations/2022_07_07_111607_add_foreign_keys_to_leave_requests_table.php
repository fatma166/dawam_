<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->foreign('company_id', 'company_leave_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('leave_type_id', 'typ_leave_fk')->references('id')->on('leave_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
            $table->foreign('user_id', 'user_leave_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropForeign('company_leave_fk');
            $table->dropForeign('typ_leave_fk');
            $table->dropForeign('user_leave_fk');
        });
    }
}
