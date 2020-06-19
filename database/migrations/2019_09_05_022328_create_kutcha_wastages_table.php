<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKutchaWastagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kutcha_wastages', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('sheet_production_id');
            $table->foreign('sheet_production_id')->references('id')->on('sheet_productions');
            $table->unsignedBigInteger('fm_kutcha_id');
            $table->foreign('fm_kutcha_id')->references('id')->on('fm_kutchas');
			$table->decimal('qty_kg', 20, 2)->default('0');
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
        Schema::dropIfExists('kutcha_wastages');
    }
}
