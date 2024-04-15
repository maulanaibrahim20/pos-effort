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
        Schema::create('grouping_satuan_bahan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("satuanBahanId", 50);
            $table->string("bahanId", 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grouping_satuan_bahan');
    }
};
