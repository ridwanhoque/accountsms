<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawMaterialBatchStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_material_batch_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->unsignedBigInteger('sub_raw_material_id');
            $table->foreign('sub_raw_material_id')->references('id')->on('sub_raw_materials');
            $table->integer('purchased_quantity')->default('0');
            $table->integer('sold_quantity')->default('0');
            $table->integer('used_quantity')->default('0');
            $table->integer('available_quantity')->default('0');
            $table->integer('purchased_bags')->default('0');
            $table->integer('sold_bags')->default('0');
            $table->integer('used_bags')->default('0');
            $table->integer('available_bags')->default('0');
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
        Schema::dropIfExists('raw_material_batch_stocks');
    }
}
