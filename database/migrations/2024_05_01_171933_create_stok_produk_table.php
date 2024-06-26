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
        Schema::create('stok_produk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('userId', 50);
            $table->string('produkId', 50);
            $table->datetime('tanggalTransaksi');
            $table->tinyInteger('qty')->default(1);
            $table->enum('status', ['0', '1'])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_produk');
    }
};
