<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StarRating extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'star_rating';

    protected $fillable = [
                            'offer_id',
                            'user_id',
                            'created_by',
                            'star_rating_item',
                            'rating',
                        ];
    
    public function offer() {
        return $this->belongsTo(\App\Models\Offer::class, 'offer_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function star_rating_item() {
        return $this->belongsTo(\App\Models\StarRatingItem::class, 'star_rating_item');
    }

}
