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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('hp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
            $table->text('nip')->nullable();
            $table->text('nis')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jenkel')->nullable();
            $table->string('tempat_lhr')->nullable();
            $table->string('tanggal_lhr')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->text('file')->nullable();
            $table->text('kelas')->nullable();
            $table->text('pendidikan')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
