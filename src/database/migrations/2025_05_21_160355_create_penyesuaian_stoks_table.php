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
        Schema::create('penyesuaian_stoks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('tipe_penyesuaian', ['Penambahan', 'Pengurangan', 'Koreksi']);
            $table->integer('jumlah_perubahan');
            $table->text('keterangan');
            $table->timestamp('tanggal_penyesuaian');
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('produks')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyesuaian_stoks');
    }
};
