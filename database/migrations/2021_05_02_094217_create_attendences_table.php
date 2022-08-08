<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_attend_fk');
            $table->integer('shift_id')->index('shift_of_attend_fk');
            $table->enum('status', ['attend', 'late']);
            $table->text('type');
            $table->integer('branch_id')->index('branch_attend_fk');
            $table->tinyInteger('is_holiday');
            $table->mediumText('longi');
            $table->mediumText('lati');
            $table->text('avatar');
            $table->timestamp('created_at')->useCurrent();
            $table->tinyInteger('is_recognized')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendences');
    }
}
