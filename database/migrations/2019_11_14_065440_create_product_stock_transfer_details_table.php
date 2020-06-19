<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockTransferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_transfer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('product_stock_transfer_id');
            $table->foreign('product_stock_transfer_id', 'pstd_pstid')->references('id')->on('product_stock_transfers');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'pstd_pid')->references('id')->on('products');
            $table->decimal('quantity', 20, 2)->default('0');
            $table->decimal('pack', 20, 2)->default('0');
            $table->decimal('weight', 20, 2)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock_transfer_details');
    }
}
