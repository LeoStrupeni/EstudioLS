<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicepackageitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_package_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_package_id')->nullable();
            $table->unsignedBigInteger('services_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('service_package_items', function (Blueprint $table) {
            $table->foreign('service_package_id')->references('id')->on('service_package');
            $table->foreign('services_id')->references('id')->on('services');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_package_items');
    }
}
