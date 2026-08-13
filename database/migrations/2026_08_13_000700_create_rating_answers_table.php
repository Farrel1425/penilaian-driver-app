<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rating_answers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('rating_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->json('answer_value')->nullable();
            $table->text('answer_text')->nullable();
            $table->timestamps();

            $table->index(['rating_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rating_answers');
    }
};
