<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferQuestionResponse extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'offer_question_response';

    protected $fillable = [
                            'star_response',
                            'text_response',
                            'offer_question_id',
                            'offer_question_type',
                            'created_by',
                            'offer_id',
                        ];
    
                        /**
     * Get the parent commentable model (post or video).
     */
    public function offerQuestions()
    {
        return $this->morphTo();
    }
}

