<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezone', function (Blueprint $table) {
            $table->integer('zone_id')->nullable()->index('idx_zone_id');
            $table->string('abbreviation', 6);
            $table->decimal('time_start', 11, 0)->index('idx_time_start');
            $table->integer('gmt_offset');
            $table->char('dst', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timezone');
    }
}
