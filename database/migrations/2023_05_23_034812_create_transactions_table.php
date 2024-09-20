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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->char('transactionUUID',16);
            $table->foreignId('package_id');
            $table->foreignId('klien_id');
            $table->integer('gross_amount');
            $table->integer('session_remaining');
            $table->enum('payment_status',['unpaid','paid','cancelled']);
            $table->enum('transaction_status',['pending','ongoing','completed']);
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('klien_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
