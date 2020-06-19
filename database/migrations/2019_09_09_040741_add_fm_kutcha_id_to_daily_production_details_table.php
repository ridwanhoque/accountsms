<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFmKutchaIdToDailyProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_production_details', function (Blueprint $table) {
            $table->unsignedBigInteger('fm_kutcha_id')->nullable();
            $table->foreign('fm_kutcha_id', 'dpd_fkid')->references('id')->on('fm_kutchas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_production_details', function (Blueprint $table) {
            $table->dropForeign('dpd_fkid');
            $table->dropColumn('fm_kutcha_id');
        });
    }
}
