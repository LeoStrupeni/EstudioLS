<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class N4UpdateBalanceMoneyMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('money_movement', function (Blueprint $table) {
            $table->unsignedBigInteger('budget_item_id')->nullable();
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->foreign('budget_item_id')->references('id')->on('budget_items');
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
