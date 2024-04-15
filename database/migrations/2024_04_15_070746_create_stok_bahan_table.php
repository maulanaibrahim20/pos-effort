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
        Schema::create('stok_bahan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("userId", 50);
            $table->string("bahanId", 50);
            $table->dateTime("tanggalTransaksi");
            $table->tinyInteger("qty");
            $table->double("hargaStokBahan");
            $table->enum("status", [1, 0]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_bahan');
    }
};
