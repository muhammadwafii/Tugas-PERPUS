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
        Schema::create('relasi', function (Blueprint $table) {
            $table->increments('KategoriBukulD');
            $table->unsignedInteger('BukuID');
            $table->unsignedInteger('KategorilD');
            $table->foreign('BukuID')->references('BukuID')->on('buku');
            $table->foreign('KategorilD')->references('KategorilD')->on('kategoribuku');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi');
    }
};