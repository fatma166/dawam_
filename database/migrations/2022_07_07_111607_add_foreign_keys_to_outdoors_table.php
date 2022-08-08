<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOutdoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outdoors', function (Blueprint $table) {
            $table->foreign('company_id', 'outdoor_com_fk')->references('id')->on('companies')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('customer_id', 'outdoor_customer_fk')->references('id')->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'outdoor_user_fk')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('visit_type_id', 'outdoor_visittyp_fk')->references('id')->on('visits_types')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outdoors', function (Blueprint $table) {
            $table->dropForeign('outdoor_com_fk');
            $table->dropForeign('outdoor_customer_fk');
            $table->dropForeign('outdoor_user_fk');
            $table->dropForeign('outdoor_visittyp_fk');
        });
    }
}
