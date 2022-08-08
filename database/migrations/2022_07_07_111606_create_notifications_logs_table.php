<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_logs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 200);
            $table->text('message');
            $table->integer('company_id');
            $table->integer('notify_from');
            $table->integer('notify_to');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('data_id');
            $table->string('type', 250);
            $table->enum('status', ['seen', 'delivered'])->default('delivered');
            $table->text('addtion_data')->nullable();
            $table->string('created_by', 20)->default('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications_logs');
    }
}
