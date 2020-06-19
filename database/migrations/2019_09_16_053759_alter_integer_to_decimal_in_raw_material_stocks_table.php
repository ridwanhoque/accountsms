<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIntegerToDecimalInRawMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raw_material_stocks', function (Blueprint $table) {
            $table->decimal('available_quantity', 20, 2)->change();
            $table->decimal('purchased_quantity', 20, 2)->change();
            $table->decimal('sold_quantity', 20, 2)->change();
            $table->decimal('used_quantity', 20, 2)->change();
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
            $table->integer('available_quantity')->change();
            $table->integer('purchased_quantity')->change();
            $table->integer('sold_quantity')->change();
            $table->integer('used_quantity')->change();
        });
    }
}
