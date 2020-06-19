<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpeningStockInRawMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raw_material_stocks', function (Blueprint $table) {
            $table->decimal('opening_quantity', 20, 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raw_material_stocks', function (Blueprint $table) {
            $table->dropColumn('opening_quantity');
        });
    }
}
