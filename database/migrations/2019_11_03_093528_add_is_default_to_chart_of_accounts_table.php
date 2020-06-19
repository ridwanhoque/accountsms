<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDefaultToChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chart_of_accounts', function (Blueprint $table) {
            $table->smallInteger('is_posting')->default('0')->change();
            $table->tinyInteger('is_default')->default('0');
            $table->unsignedBigInteger('chart_type_id')->nullable();
            $table->foreign('chart_type_id', 'ca_ctid')->references('id')->on('chart_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chart_of_accounts', function (Blueprint $table) {
            $table->dropColumn('is_default');
            $table->dropForeign('ca_ctid');
            $table->dropColumn('chart_type_id');
        });
    }
}
