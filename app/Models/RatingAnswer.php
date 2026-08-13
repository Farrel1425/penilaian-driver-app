<?php

namespace App\Models;

use Database\Factories\RatingAnswerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['rating_id', 'question_id', 'answer_value', 'answer_text'])]
class RatingAnswer extends Model
{
    /** @use HasFactory<RatingAnswerFactory> */
    use HasFactory;

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    protected function casts(): array
    {
        return [
            'answer_value' => 'array',
        ];
    }
}
