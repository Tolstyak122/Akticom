<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_binds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('good_id', false, true);
            $table->bigInteger('property_id', false, true);

            $table->foreign('good_id')->references('id')->on('goods');
            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_binds');
    }
};
