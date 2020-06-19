<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpeningKgInKutchaWastageStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kutcha_wastage_stocks', function (Blueprint $table) {
            $table->decimal('opening_kg', 20, 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kutcha_wastage_stocks', function (Blueprint $table) {
            $table->dropColumn('opening_kg');
        });
    }
}
