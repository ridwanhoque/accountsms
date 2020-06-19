<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSheetProductionIdToSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('sheet_production_details_id')->nullable()->change();
            $table->unsignedBigInteger('sub_raw_material_id')->nullable()->change();
			$table->unsignedBigInteger('sheet_production_id')->nullable();
            $table->foreign('sheet_production_id', 's_spid')->references('id')->on('sheet_productions');
            $table->unsignedBigInteger('fm_kutcha_id')->nullable();
            $table->foreign('fm_kutcha_id', 's_fkid')->references('id')->on('fm_kutchas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->dropForeign('s_spid');
            $table->dropColumn('sheet_production_id');
            $table->dropForeign('s_fkid');
            $table->dropColumn('fm_kutcha_id');
        });
    }
}
