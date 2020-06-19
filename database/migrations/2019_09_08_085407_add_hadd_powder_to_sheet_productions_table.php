<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHaddPowderToSheetProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheet_productions', function (Blueprint $table) {
            $table->decimal('haddi', 20, 2)->default('0');
            $table->decimal('powder', 20, 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheet_productions', function (Blueprint $table) {
            $table->dropColumn('haddi');
            $table->dropColumn('powder');
        });
    }
}
