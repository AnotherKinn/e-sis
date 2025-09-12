<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa_lengkap', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable()->change();
            $table->foreignId('jurusan_id')->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->string('tanggal_lahir')->nullable()->change();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('siswa_lengkap', function (Blueprint $table) {
            $table->foreignId('kelas_id')->nullable(false)->change();
            $table->foreignId('jurusan_id')->nullable(false)->change();
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->string('tanggal_lahir')->nullable(false)->change();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable(false)->change();
        });
    }
};
