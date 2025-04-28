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
        Schema::create('buku_besars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('akun_id')->references('id')->on('akuns')->onDelete('cascade');
            $table->foreignId('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->float('debit');
            $table->float('kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_besars');
    }
};
