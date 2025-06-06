<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nomor_pengaduan')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('judul')->nullable();
            $table->text('isi_pengaduan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lokasi')->nullable(); // Kolom lokasi lama dipertahankan
            $table->text('tanggapan')->nullable();
            $table->string('aksi')->nullable();
            $table->timestamps();

            // --- TAMBAHAN UNTUK GIS ---
            $table->decimal('latitude', 10, 7)->nullable();  // Menambah kolom latitude
            $table->decimal('longitude', 10, 7)->nullable(); // Menambah kolom longitude
            // --- AKHIR TAMBAHAN ---

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus foreign key dulu jika ada
            $table->dropColumn(['tanggapan', 'latitude', 'longitude']); // Hapus kolom yang ditambahkan
        });
        Schema::dropIfExists('aduans'); // Drop tabel aduans jika tidak ada kolom lain yang penting
    }
};