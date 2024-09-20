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
        Schema::create('counselings', function (Blueprint $table) {
            $table->id();
            $table->char('counselingUUID',16);
            $table->foreignId('counselor_id');
            $table->foreignId('transaction_id');
            $table->foreignId('klien_id');
            $table->text('issues');
            $table->date('counseling_date');
            $table->time('counseling_start');
            $table->time('counseling_end');
            $table->string('link_meet')->nullable();
            $table->enum('status_counseling',['waiting payment','scheduled','ongoing','completed','cancelled']);
            $table->timestamps();

            $table->foreign('counselor_id')->references('id')->on('users');
            $table->foreign('klien_id')->references('id')->on('users');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselings');
    }
};
