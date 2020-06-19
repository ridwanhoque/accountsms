<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetMaterialStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_material_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('sheet_production_details_id');
            $table->foreign('sheet_production_details_id')->references('id')->on('sheet_production_details');
            $table->unsignedBigInteger('sheet_size_id');
            $table->foreign('sheet_size_id')->references('id')->on('sheet_sizes');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->decimal('total_quantity_roll', 20, 2)->default('0');
            $table->decimal('used_quantity_roll', 20, 2)->default('0');
            $table->decimal('available_quantity_roll', 20, 2)->default('0');
            $table->decimal('total_quantity_kg', 20, 2)->default('0');
            $table->decimal('used_quantity_kg', 20, 2)->default('0');
            $table->decimal('available_quantity_kg', 20, 2)->default('0');
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
        Schema::dropIfExists('sheet_material_stocks');
    }
}
