<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('branch_id', 'att_branch_fk')->references('id')->on('branches')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('company_id', 'att_company_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('shift_id', 'shift_att_fk')->references('id')->on('shifts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'user_att_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign('att_branch_fk');
            $table->dropForeign('att_company_fk');
            $table->dropForeign('shift_att_fk');
            $table->dropForeign('user_att_fk');
        });
    }
}
