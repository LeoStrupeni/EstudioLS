<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_opening', function (Blueprint $table) {
            $table->id();
            $table->enum('type_money', ['dolar', 'peso', 'jus']);
            $table->enum('type', ['saldo', 'cotizacion']);
            $table->enum('status', ['activo', 'inactivo']);
            $table->double('price', 20, 4)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_opening');
    }
}
