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
            $table->uuid("id")->primary();
            $table->string("invoiceId", 50);
            $table->string("namaUser", 100);
            $table->string("emailUser", 100);
            $table->string("nomorHpAktif", 30);
            $table->double("totalHarga");
            $table->tinyInteger("status")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
