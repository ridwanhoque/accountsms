<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToVoucherChartPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voucher_chart_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_account_chart_id');
            $table->foreign('voucher_account_chart_id', 'vchartid')->references('id')->on('voucher_account_charts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voucher_chart_payments', function (Blueprint $table) {
            $table->dropForeign('vchartid');
            $table->dropColumn('voucher_account_chart_id');
        });
    }
}
