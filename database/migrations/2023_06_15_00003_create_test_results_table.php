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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->char('testResult_uuid',16);
            $table->foreignId('klien_id')->constrained('users');
            $table->foreignId('counselor_id')->nullable()->constrained('users');
            $table->foreignId('test_id')->constrained('tests');
            $table->json('answer');
            $table->integer('score');
            $table->text('hasil_analisis')->nullable();
            $table->text('saran')->nullable();
            $table->text('penjelasan_singkat')->nullable();
            $table->text('solusi')->nullable();
            $table->enum('status_result',['noCounselor','withCounselor','completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
