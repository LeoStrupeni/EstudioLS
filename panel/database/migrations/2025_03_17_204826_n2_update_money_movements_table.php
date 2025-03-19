<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class N2UpdateMoneyMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('money_movement', function (Blueprint $table) {
            $table->dropColumn('type_document');
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->unsignedBigInteger('type_document')->nullable();
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->foreign('type_document')->references('id')->on('types_doc_movement');
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
