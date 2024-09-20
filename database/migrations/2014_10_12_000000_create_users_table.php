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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('uuid',16);
            $table->string('slug_user');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('phone_number');
            $table->string('gender')->nullable();
            $table->integer('umur')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('kota')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('foto')->nullable();
            $table->string('izin_konselor')->nullable();
            $table->bigInteger('npwp')->nullable();
            $table->text('keahlian_utama')->nullable();
            $table->text('keahlian_lainnya')->nullable();
            $table->text('pendekatan')->nullable();
            $table->string('user_type')->nullable();
            $table->string('status_user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
