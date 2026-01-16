<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cabang', 200);
            $table->string('jenis_bisnis', 50);
            $table->text('alamat');
            $table->string('telepon', 20)->nullable();
            $table->string('kota', 50);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('nama_cabang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};
