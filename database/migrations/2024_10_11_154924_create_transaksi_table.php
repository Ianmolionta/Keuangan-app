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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('jumlah');
            $table->enum('transaksi',['pemasukan', 'pengeluaran']);
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_transaksi');
    }
};
