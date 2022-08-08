<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_leaves', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('leave_type_id')->default(1)->index('leavetype_fk');
            $table->integer('num_days');
            $table->mediumText('user_id');
            $table->date('updated_at');
            $table->date('created_at');
            $table->text('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_leaves');
    }
}
