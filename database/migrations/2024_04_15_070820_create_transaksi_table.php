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
            $table->string("xenditId", 150)->nullable();
            $table->string("namaUser", 100);
            $table->string("nomorHpAktif", 30)->nullable();
            $table->double("totalHarga");
            $table->string("kasirId", 50);
            $table->tinyInteger("status")->default(1);
            $table->enum("tipeTransaksi", ["CASH", "TRANSFER"])->nullable();
            $table->string("statusOrder", 50)->nullable();
            $table->string("paymentChannel", 100)->nullable();
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
