<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductBranchStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_branch_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('transferred_quantity', 20, 2)->default('0');
            $table->decimal('transferred_pack', 20, 2)->default('0');
            $table->decimal('transferred_weight', 20, 2)->default('0');
            $table->decimal('sold_quantity', 20, 2)->default('0');
            $table->decimal('sold_pack', 20, 2)->default('0');
            $table->decimal('sold_weight', 20, 2)->default('0');
            $table->decimal('available_quantity', 20, 2)->default('0');
            $table->decimal('available_pack', 20, 2)->default('0');
            $table->decimal('available_weight', 20, 2)->default('0');
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
        Schema::dropIfExists('product_branch_stocks');
    }
}
