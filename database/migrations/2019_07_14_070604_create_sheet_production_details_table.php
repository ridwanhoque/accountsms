<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->string('sheet_production_details_code')->unique();
            $table->unsignedBigInteger('sheet_production_id');
            $table->foreign('sheet_production_id')->references('id')->on('sheet_productions');
            $table->unsignedBigInteger('sheet_size_id');
            $table->foreign('sheet_size_id')->references('id')->on('sheet_sizes');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->decimal('qty_roll', 20, 2)->default('0');
            $table->decimal('qty_kg', 20, 2)->default('0');
            $table->string('description')->nullable();
            $table->unique(['sheet_production_id', 'sheet_size_id', 'color_id'], 'sprod_ssize_col_id');
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
        Schema::dropIfExists('sheet_production_details');
    }
}
