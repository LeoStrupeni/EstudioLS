<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class N1UpdateMoneyMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('money_movement', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_accounts_id')->default(1);
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->foreign('bank_accounts_id')->references('id')->on('bank_accounts');
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
