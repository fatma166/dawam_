<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCompanyPlanAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_plan_addons', function (Blueprint $table) {
            $table->foreign('addon_id', 'addons_fk')->references('id')->on('add_ons')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('companyplan_id', 'compplan_fk')->references('id')->on('company_plans')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_plan_addons', function (Blueprint $table) {
            $table->dropForeign('addons_fk');
            $table->dropForeign('compplan_fk');
        });
    }
}
