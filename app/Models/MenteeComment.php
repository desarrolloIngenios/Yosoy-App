<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenteeComment extends Model
{
    use HasFactory;

    protected $table = 'mentee_comments';

    protected $fillable = [
        'mentee_id',
        'author_id',
        'comment',
    ];

    /**
     * The mentee (user) that this comment belongs to.
     */
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    /**
     * The author (user) who wrote the comment.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
