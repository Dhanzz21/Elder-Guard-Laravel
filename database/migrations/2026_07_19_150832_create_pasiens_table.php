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
        Schema::create('pasiens', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('akun_pasien_id')->nullable()->constrained('users')->onDelete('set null'); 
    $table->string('nama_lengkap');
    $table->integer('usia');
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->float('berat_badan')->nullable();
    $table->float('tinggi_badan')->nullable();
    $table->string('status')->default('Aktif');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
