<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflows', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('shift_id')->index('shift_workflow_fk');
            $table->integer('company_id')->index('workflow_comp_fk');
            $table->integer('minutes');
            $table->integer('hours');
            $table->mediumText('description');
            $table->enum('type', ['overtime', 'late', 'before_leave'])->default('late');
            $table->timestamp('updated_at')->useCurrent();
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
        Schema::dropIfExists('workflows');
    }
}
