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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('sku')->unique()->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_beli', 15, 2);
            $table->decimal('harga_jual', 15, 2);
            $table->integer('stok')->default(0);
            $table->decimal('berat', 10, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->string('gambar')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Discontinued']);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->nullOnDelete();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
