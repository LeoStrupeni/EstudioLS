<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class N3UpdateMoneyMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('money_movement', function (Blueprint $table) {
            $table->dropColumn('budget_id');
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->unsignedBigInteger('budget_id')->nullable();
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->foreign('budget_id')->references('id')->on('budgets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
