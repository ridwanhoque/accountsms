<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporaryDailyProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_daily_production_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('daily_production_id');
            $table->foreign('daily_production_id')->references('id')->on('daily_productions');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('sheetproductiondetails_color_id');
            $table->foreign('sheetproductiondetails_color_id', 'tdpd_scid')->references('id')->on('sheetproductiondetails_colors');
            $table->string('daily_production_details_code')->unique('dpd_dpdc');
            $table->decimal('wastage_out', 20, 2)->default('0');
            $table->decimal('standard_weight', 20, 2)->default('0');
            $table->decimal('todays_weight', 20, 2)->default('0');
            $table->string('cavity')->nullable();
            $table->decimal('expected_quantity', 20, 2)->nullable();
            $table->decimal('finish_quantity', 20, 2)->default('0');
            $table->decimal('pack', 20, 2)->default('0');
            $table->decimal('net_weight', 20, 2)->default('0');
            $table->string('run_time')->nullable();
            $table->string('hours_per_minute')->nullable();
            $table->decimal('sheet_wastage', 20, 2)->default('0');
            $table->decimal('forming_wastage', 20, 2)->default('0');
            $table->text('reason')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('temporary_daily_production_details');
    }
}
