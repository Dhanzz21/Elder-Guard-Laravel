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
        Schema::create('kejadians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            
            // Hapus huruf 's' pada kata 'sensor_data' di dalam constrained()
            $table->foreignId('sensor_data_id')->nullable()->constrained('sensor_data')->onDelete('set null');
            
            $table->string('jenis_kejadian'); 
            $table->enum('tingkat_keparahan', ['Rendah', 'Sedang', 'Tinggi', 'Kritis']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadians');
    }
};
