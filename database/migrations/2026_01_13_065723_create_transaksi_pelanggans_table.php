<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_pelanggan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_customer')
                ->constrained('customers', 'id')
                ->onDelete('cascade');

            $table->foreignId('id_cabang')
                ->constrained('cabang', 'id')
                ->onDelete('cascade');

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');

            $table->date('tanggal');
            $table->string('hari', 10);
            $table->string('tipe_customer', 50); 
            $table->string('alamat', 255)->nullable();
            $table->string('sumber_informasi', 50); 
            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->index('tanggal');
            $table->index('id_customer');
            $table->index('id_cabang');
            $table->index(['id_cabang', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_pelanggan');
    }
};