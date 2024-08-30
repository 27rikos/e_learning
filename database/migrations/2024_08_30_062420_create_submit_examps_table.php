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
        Schema::create('submit_examps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tugas')->constrained('examps')->cascadeOnDelete();
            $table->foreignId('id_siswa')->constrained('users')->cascadeOnDelete();
            $table->text('file');
            $table->date('tanggal');
            $table->string('nilai')->nullable();
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
        Schema::dropIfExists('submit_examps');
    }
};