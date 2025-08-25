<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('fecha');
            $table->integer('valid')->nullable();
            $table->double('total_pesos', 20, 4)->default(0);
            $table->double('total_dollars', 20, 4)->default(0);
            $table->double('total_jus', 20, 4)->default(0);
            $table->enum('estatus', ['abierto', 'cerrado', 'rechazado'])->default('abierto');
            $table->text('observations')->nullable();
            $table->text('includes')->nullable();
            $table->text('not_includes')->nullable();
            $table->text('payment_methods')->nullable();
            $table->text('clarifications')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients');
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
        Schema::dropIfExists('budget');
    }
}
