<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectProductionDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('direct_production_id');
            $table->foreign('direct_production_id')->references('id')->on('direct_productions');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->decimal('todays_weight', 20, 2)->default('0');
            $table->decimal('finish_quantity', 20, 2)->default('0');
            $table->decimal('pack', 20, 2)->default('0');
            $table->decimal('net_weight', 20, 2)->default('0');
            $table->unsignedBigInteger('fm_kutcha_id');
            $table->foreign('fm_kutcha_id')->references('id')->on('fm_kutchas');
            $table->decimal('kutcha_qty', 20, 2)->default('0');
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
        Schema::dropIfExists('direct_production_details');
    }
}
