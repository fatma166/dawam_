<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workflows', function (Blueprint $table) {
            $table->foreign('shift_id', 'shift_workflow_fk')->references('id')->on('shifts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('company_id', 'workflow_comp_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workflows', function (Blueprint $table) {
            $table->dropForeign('shift_workflow_fk');
            $table->dropForeign('workflow_comp_fk');
        });
    }
}
