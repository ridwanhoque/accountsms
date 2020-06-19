<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpeningToSheetStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheet_stocks', function (Blueprint $table) {
            $table->decimal('opening_kg', 20, 2)->default('0');
            $table->decimal('opening_roll', 20, 2)->default('0');
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
            $table->dropColumn('opening_kg');
            $table->dropColumn('opening_roll');
        });
    }
}
