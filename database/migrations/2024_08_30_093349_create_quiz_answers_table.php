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
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_soal')->constrained('quizzes')->cascadeOnDelete();
            $table->foreignId('id_siswa')->constrained('users')->cascadeOnDelete();
            $table->string('lama');
            $table->string('nilai');
            $table->string('jumlah_benar');
            $table->integer('chance');
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
        Schema::dropIfExists('quiz_answers');
    }
};