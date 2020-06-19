<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToDailyProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_production_details', function (Blueprint $table) {
            $table->dropForeign('daily_production_details_sheetproductiondetails_color_id_foreign');
            $table->dropColumn('sheetproductiondetails_color_id');
            $table->unsignedBigInteger('sheet_size_color_id');
            $table->foreign('sheet_size_color_id', 'dp_sscid')->references('id')->on('sheet_size_colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_production_details', function (Blueprint $table) {
            $table->unsignedBigInteger('sheetproductiondetails_color_id');
            $table->foreign('sheetproductiondetails_color_id')->references('id')->on('sheetproductiondetails_colors');
            $table->dropForeign('dp_sscid');
            $table->dropColumn('sheet_size_color_id');
        });
    }
}
