<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('PeminjamanID');
            $table->unsignedInteger('UserID'); 
            $table->unsignedInteger('BukuID'); 
            $table->date('TanggalPeminjaman');
            $table->date('TanggalPengembalian');
            $table->string('StatusPeminjaman', 50);

    
            $table->foreign('UserID')->references('UserID')->on('user')->onDelete('cascade');
            $table->foreign('BukuID')->references('BukuID')->on('buku')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
