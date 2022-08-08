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
            $table->date('date');
            $table->text('lati');
            $table->text('longi');
            $table->text('adress');
            $table->string('title', 225);
            $table->text('description')->nullable();
            $table->enum('status', ['start', 'inprogress', 'done', 'pending'])->default('pending');
            $table->string('created_by', 200)->default('admin');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('visit_type_id')->nullable()->index('outdoor_visittyp_fk');
            $table->integer('company_id')->index('outdoor_com_fk');
            $table->integer('customer_id')->nullable()->index('outdoor_customer_fk');
            $table->boolean('is_registered')->default(0);
            $table->smallInteger('rate')->default(0);
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
