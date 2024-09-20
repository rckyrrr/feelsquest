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
        Schema::create('counseling_results', function (Blueprint $table) {
            $table->id();
            $table->char('resultCounseling_uuid',16);
            $table->foreignId('counseling_id')->constrained('counselings');
            $table->text('permasalahan');
            $table->text('catatan');
            $table->text('evaluasi_psikis')->nullable();
            $table->text('hal_diperhatikan')->nullable();
            $table->text('saran')->nullable();
            $table->text('feedback_user')->nullable();
            $table->text('masukan_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_results');
    }
};
