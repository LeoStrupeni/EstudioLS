<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance', function (Blueprint $table) {
            $table->id();
            $table->double('dolar', 20, 4)->default(0);
            $table->dateTime('dolar_updated_at', $precision = 0);
            $table->double('peso', 20, 4)->default(0);
            $table->dateTime('peso_updated_at', $precision = 0);
            $table->timestamps();
            $table->text('last_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance');
    }
}
