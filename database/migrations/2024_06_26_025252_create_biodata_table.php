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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender', ['Pria', 'Wanita'])->nullable();
            $table->string('email')->nullable();
            $table->string('kelas')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('jurusan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mapel_fav');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mapel_fav')->references('id')->on('mata_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
