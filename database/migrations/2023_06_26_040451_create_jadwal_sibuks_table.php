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
        Schema::create('jadwal_sibuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('counselor_id')->constrained('users');
            $table->date('jadwal_date');
            $table->string('jadwal_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sibuks');
    }
};
