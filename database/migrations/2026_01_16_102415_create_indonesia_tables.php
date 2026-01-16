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
        // Tabel Provinsi
        Schema::create('indonesia_provinces', function (Blueprint $table) {
            $table->char('id', 2)->primary();
            $table->string('name');
            $table->timestamps();
        });

        // Tabel Kota/Kabupaten
        Schema::create('indonesia_cities', function (Blueprint $table) {
            $table->char('id', 4)->primary();
            $table->char('province_id', 2);
            $table->string('name');
            $table->timestamps();

            $table->foreign('province_id')
                ->references('id')
                ->on('indonesia_provinces')
                ->onDelete('cascade');
        });

        // Tabel Kecamatan
        Schema::create('indonesia_districts', function (Blueprint $table) {
            $table->char('id', 7)->primary();
            $table->char('city_id', 4);
            $table->string('name');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('indonesia_cities')
                ->onDelete('cascade');
        });

        // Tabel Kelurahan/Desa
        Schema::create('indonesia_villages', function (Blueprint $table) {
            $table->char('id', 10)->primary();
            $table->char('district_id', 7);
            $table->string('name');
            $table->timestamps();

            $table->foreign('district_id')
                ->references('id')
                ->on('indonesia_districts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indonesia_villages');
        Schema::dropIfExists('indonesia_districts');
        Schema::dropIfExists('indonesia_cities');
        Schema::dropIfExists('indonesia_provinces');
    }
};
