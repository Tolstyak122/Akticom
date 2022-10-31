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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code', 50)->unique('code');
            $table->string('title', 500);
            $table->bigInteger('unit_id', false, true);
            $table->bigInteger('folder_id', false, true)->nullable();
            $table->bigInteger('file_id', false, true)->nullable();
            $table->decimal('price', 10, 2, true);
            $table->decimal('price_sp', 10, 2, true);
            $table->decimal('quantity', 10, 3);
            $table->tinyInteger('group_buy', false, true);
            $table->tinyInteger('main_page', false, true);
            $table->text('desc');

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
};
