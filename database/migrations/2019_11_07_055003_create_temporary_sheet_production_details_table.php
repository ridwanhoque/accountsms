<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporarySheetProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_sheet_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('temporary_sheet_production_id');
            $table->foreign('temporary_sheet_production_id', 'tspd_tspid')->references('id')->on('temporary_sheet_productions');
            $table->unsignedBigInteger('sub_raw_material_id')->nullable();
            $table->foreign('sub_raw_material_id')->references('id')->on('sub_raw_materials');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->unsignedBigInteger('fm_kutcha_id')->nullable();
            $table->foreign('fm_kutcha_id')->references('id')->on('fm_kutchas');
            $table->unsignedBigInteger('sheet_size_id')->nullable();
            $table->foreign('sheet_size_id')->references('id')->on('sheet_sizes');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->tinyInteger('sheet_type')->default('1');
            $table->decimal('qty_kgs', 20, 2)->default('0');
            $table->decimal('sheet_rolls', 20, 2)->default('0');
            $table->decimal('sheet_kgs', 20, 2)->default('0');
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
        Schema::dropIfExists('temporary_sheet_production_details');
    }
}
