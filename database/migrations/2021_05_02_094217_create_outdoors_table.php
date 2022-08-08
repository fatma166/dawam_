<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutdoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outdoors', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('outdoor_user_fk');
            $table->timestamp('time_from')->useCurrent();
            $table->timestamp('time_to')->nullable();
            $table->text('lati');
            $table->text('longi');
            $table->text('adress');
            $table->enum('status', ['start', 'inprogress', 'done','pending'])->default('pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outdoors');
    }
}
