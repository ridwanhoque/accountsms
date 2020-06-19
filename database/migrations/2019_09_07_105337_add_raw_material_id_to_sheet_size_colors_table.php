<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRawMaterialIdToSheetSizeColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheet_size_colors', function (Blueprint $table) {
            $table->unsignedBigInteger('sheet_production_details_id')->nullable()->change();
            $table->unsignedBigInteger('raw_material_id');
            $table->foreign('raw_material_id', 'ssc_rmid')->references('id')->on('raw_materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheet_size_colors', function (Blueprint $table) {
            $table->dropForeign('ssc_rmid');
            $table->dropColumn('raw_material_id');
        });
    }
}
