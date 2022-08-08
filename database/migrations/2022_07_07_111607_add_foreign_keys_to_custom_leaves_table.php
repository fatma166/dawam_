<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_leaves', function (Blueprint $table) {
            $table->foreign('leave_type_id', 'leavetype_fk')->references('id')->on('leave_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_leaves', function (Blueprint $table) {
            $table->dropForeign('leavetype_fk');
        });
    }
}
