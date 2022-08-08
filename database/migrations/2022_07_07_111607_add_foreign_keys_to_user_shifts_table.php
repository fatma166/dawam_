<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_shifts', function (Blueprint $table) {
            $table->foreign('company_id', 'comp_user_shift_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'shift_user_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('shift_id', 'usershift_shift_fk')->references('id')->on('shifts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_shifts', function (Blueprint $table) {
            $table->dropForeign('comp_user_shift_fk');
            $table->dropForeign('shift_user_fk');
            $table->dropForeign('usershift_shift_fk');
        });
    }
}
