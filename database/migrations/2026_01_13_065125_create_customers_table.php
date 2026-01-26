<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer', 150);
            $table->string('no_hp', 20)->unique();
            $table->string('id_provinsi', 10)->nullable();
            $table->string('nama_provinsi', 100)->nullable();
            $table->string('id_kota', 10)->nullable();
            $table->string('nama_kota', 100)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('deleted_by')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->index('no_hp');
            $table->index('nama_customer');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
