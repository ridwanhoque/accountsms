<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRawMaterialToSheetSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheet_sizes', function (Blueprint $table) {
            $table->dropUnique('sheet_sizes_name_unique');
            $table->unsignedBigInteger('raw_material_id')->nullable();
            $table->foreign('raw_material_id', 'ss_rmid')->references('id')->on('raw_materials');
            $table->unique(['name', 'raw_material_id'], 'ss_name_rmid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheet_sizes', function (Blueprint $table) {
            $table->dropForeign('ss_rmid');
            $table->dropColumn('raw_material_id');
        });
    }
}
