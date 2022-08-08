<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExceptionHolydaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exception_holydays', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('date');
            $table->date('date_to');
            $table->integer('branch_id')->index('holday_branch_fk');
            $table->integer('department_id')->index('holday_department_fk');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exception_holydays');
    }
}
