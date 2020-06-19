<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherChartPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_chart_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('account_information_id');
//            $table->unsignedBigInteger('chart_of_account_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('voucher_payment_id');

            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('account_information_id')->references('id')->on('account_information');
//            $table->foreign('chart_of_account_id')->references('id')->on('chart_of_accounts');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('voucher_payment_id')->references('id')->on('voucher_payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_chart_payments');
    }
}
