<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyMovementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_movement', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['ingreso', 'egreso', 'cambio', 'caja']);
            $table->enum('type_money', ['dolar', 'peso']);
            $table->enum('type_document', ['compra', 'anticipo', 'factura', 'notaderemision', 'nomina', 'prestamo']);
            $table->enum('type_payment', ['efectivo', 'transferencia', 'credito', 'mercadopago']);
            $table->text('payment_detail')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('concepto',255)->nullable();
            $table->text('description')->nullable();
            $table->double('deposit', 20, 4)->default(0);
            $table->double('expense', 20, 4)->default(0);
            $table->double('price_usd', 20, 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('money_movement', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money_movement');
    }
}
