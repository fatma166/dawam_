<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('token',6);
            $table->enum('media', ['phone', 'email']);
            $table->enum('action', ['reset-pass', 'activate-phone','activate-email']);
            $table->boolean('confirmed')->nullable()->default(false);
            $table->integer('user_id')->index('token_user_fk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens');
    }
}
