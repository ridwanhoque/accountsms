<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryDirectProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_direct_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('temporary_direct_production_id');
            $table->foreign('temporary_direct_production_id', 'tdpd_tdpid')->references('id')->on('temporary_direct_productions');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'tdpd_pid')->references('id')->on('products');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->foreign('machine_id', 'tdpd_mid')->references('id')->on('machines');
            $table->unsignedBigInteger('fm_kutcha_id')->nullable();
            $table->foreign('fm_kutcha_id', 'tdpd_fkid')->references('id')->on('fm_kutchas');
            $table->unsignedBigInteger('sub_raw_material_id')->nullable();
            $table->foreign('sub_raw_material_id', 'tdpd_srmid')->references('id')->on('sub_raw_materials');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'tdpd_bid')->references('id')->on('batches');
            $table->tinyInteger('production_type')->default('0');
            $table->decimal('todays_weight', 20, 2)->default('0');
            $table->decimal('finish_quantity', 20, 2)->default('0');
            $table->decimal('pack', 20, 2)->default('0');
            $table->decimal('net_weight', 20, 2)->default('0');
            $table->decimal('qty_kgs', 20, 2)->default('0');
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
        Schema::dropIfExists('temporary_direct_production_details');
    }
}
