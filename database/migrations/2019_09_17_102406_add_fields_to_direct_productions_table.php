<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDirectProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('direct_productions', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id', 'dp_cid')->references('id')->on('companies');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by', 'dp_cbid')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by', 'dp_ubid')->references('id')->on('users');
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id', 'dp_bid')->references('id')->on('batches');
            $table->date('direct_production_date');
            $table->decimal('total_input', 20, 2)->default('0');
            $table->decimal('total_todays_weight', 20, 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direct_productions', function (Blueprint $table) {
            $table->dropForeign('dp_cid');
            $table->dropColumn('company_id');
            $table->dropForeign('dp_cbid');
            $table->dropColumn('created_by');
            $table->dropForeign('dp_ubid');
            $table->dropColumn('updated_by');
            $table->dropForeign('dp_bid');
            $table->dropColumn('batch_id');
            $table->dropColumn('direct_production_date');
            $table->dropColumn('total_input');
            $table->dropColumn('total_todays_weight');
        });
    }
}
