<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMachineIdToDirectProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direct_production_details', function (Blueprint $table) {
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id', 'dpd_mid')->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direct_production_details', function (Blueprint $table) {
            $table->dropForeign('dpd_mid');
            $table->dropColumn('machine_id');
        });
    }
}
