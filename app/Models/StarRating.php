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
                            'comment',
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
    
    static public function is_rating_user_offer($user_id, $offer_id) {
        $star_rating = self::where('user_id', $user_id)->where('offer_id', $offer_id)->get();
        $star_rating = $star_rating->first();
        if(is_null($star_rating)){
            return false;
        } else {
            return true;
        }
    }

    public function star_rating_items_selected()
    {
        return $this->belongsToMany(StarRatingItem::class, 'star_rating_items_selected', 'star_rating_id', 'star_rating_item_id');
    }
    

}
