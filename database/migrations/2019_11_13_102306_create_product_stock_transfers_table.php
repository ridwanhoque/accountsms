<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->date('product_stock_transfer_date');
            $table->unsignedBigInteger('from_branch')->nullable();
            $table->foreign('from_branch')->references('id')->on('branches');
            $table->unsignedBigInteger('to_branch')->nullable();
            $table->foreign('to_branch')->references('id')->on('branches');
            $table->decimal('total_quantity', 20, 2)->default('0');
            $table->decimal('total_pack', 20, 2)->default('0');
            $table->decimal('total_weight', 20, 2)->default('0');
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
        Schema::dropIfExists('product_stock_transfers');
    }
}
