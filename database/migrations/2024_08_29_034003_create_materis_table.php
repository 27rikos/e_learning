<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->text('materi'); // Judul materi
            $table->foreignId('id_materi')->constrained('ruangans')->cascadeOnDelete(); // Relasi dengan tabel ruangans
            // Kolom untuk kuis
            $table->text('pertanyaan')->nullable(); // Pertanyaan kuis
            $table->string('pilihan_a')->nullable(); // Pilihan A
            $table->string('pilihan_b')->nullable(); // Pilihan B
            $table->string('pilihan_c')->nullable(); // Pilihan C
            $table->string('pilihan_d')->nullable(); // Pilihan D
            $table->string('pilihan_e')->nullable(); // Pilihan E
            $table->string('kunci_jawaban')->nullable(); // Kunci jawaban

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materis');
    }
};
