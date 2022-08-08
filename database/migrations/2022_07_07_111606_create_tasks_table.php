<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 200);
            $table->dateTime('start_date');
            $table->date('due_date');
            $table->integer('user_id')->index('tasks_user_fk');
            $table->enum('status', ['delivered', 'seen', 'in_progress', 'done', 'late'])->default('delivered');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->text('description')->nullable();
            $table->integer('in_progress')->nullable();
            $table->integer('company_id')->nullable()->index('company_tasks_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
