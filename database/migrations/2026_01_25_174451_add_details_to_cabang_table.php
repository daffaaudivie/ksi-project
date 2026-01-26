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
        Schema::table('cabang', function (Blueprint $table) {
            $table->string('id_provinsi', 10)->nullable()->after('telepon');
            $table->string('nama_provinsi', 100)->nullable()->after('id_provinsi');
            $table->string('id_kota', 10)->nullable()->after('nama_provinsi');
            $table->string('nama_kota', 100)->nullable()->after('id_kota');

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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cabang', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);

            $table->dropColumn([
                'id_provinsi',
                'nama_provinsi',
                'id_kota',
                'nama_kota',
                'created_by',
                'updated_by',
                'deleted_by'
            ]);
        });
    }
};
