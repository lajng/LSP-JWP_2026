<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persediaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->unique()->constrained('barangs')->onDelete('cascade');
            $table->integer('stok_masuk')->default(0);
            $table->integer('stok_keluar')->default(0);
            $table->integer('stok_akhir')->default(0);
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->default('Tidak Tersedia');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('persediaans');
    }
};
