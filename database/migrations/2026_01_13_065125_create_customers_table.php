<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer', 150);
            $table->string('no_hp', 20)->unique();
            $table->string('alamat_utama', 255)->nullable();
            $table->string('tipe_default', 50)->default('Perorangan');
            $table->string('email', 100)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('no_hp');
            $table->index('nama_customer');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
