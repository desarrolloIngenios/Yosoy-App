<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferQuestionText extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'offer_question_text';

    protected $fillable = [
                            'name',
                            'active',
                        ];

    public function offerQuestions()
    {
        return $this->morphMany(OfferQuestionResponse::class, 'offer_question');
    }
}