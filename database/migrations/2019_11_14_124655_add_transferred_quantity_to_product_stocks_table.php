<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransferredQuantityToProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->decimal('transferred_quantity', 20, 2)->default('0');
            $table->decimal('transferred_pack', 20, 2)->default('0');
            $table->decimal('transferred_weight', 20, 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropColumn('transferred_quantity');
            $table->dropColumn('transferred_pack');
            $table->dropColumn('transferred_weight');
        });
    }
}
