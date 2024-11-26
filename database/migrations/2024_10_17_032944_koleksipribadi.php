<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('koleksipribadi', function (Blueprint $table) {
            $table->increments('KoleksiID');
            $table->unsignedInteger('UserID');
            $table->unsignedInteger('BukuID');
    
            // Foreign key constraints
            $table->foreign('UserID')->references('UserID')->on('user');
            $table->foreign('BukuID')->references('BukuID')->on('buku');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
