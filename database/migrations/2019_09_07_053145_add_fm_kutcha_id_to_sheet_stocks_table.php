<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFmKutchaIdToSheetStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheet_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('sheet_size_id')->nullable()->change();
            $table->unsignedBigInteger('color_id')->nullable()->change();
            $table->unsignedBigInteger('sub_raw_material_id');
            $table->foreign('sub_raw_material_id', 'ss_srmid')->references('id')->on('sub_raw_materials');
            $table->decimal('used_kg')->default('0');
            $table->decimal('used_roll')->default('0');
            $table->decimal('available_kg')->default('0');
            $table->decimal('available_roll')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheet_stocks', function (Blueprint $table) {
            $table->dropForeign('ss_srmid');
            $table->dropColumn('sub_raw_material_id');
            $table->dropColumn('used_kg');
            $table->dropColumn('used_roll');
            $table->dropColumn('available_kg');
            $table->dropColumn('available_roll');
        });
    }
}
