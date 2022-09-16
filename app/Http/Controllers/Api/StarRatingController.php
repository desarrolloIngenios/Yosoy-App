<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StarRatingItem;
use App\Models\StarRating;





class StarRatingController extends BaseController
{

    public function star_rating_by_user(Request $request)
    {
        $user = $request->user();
        $star_rating = User::getStarRating($user->id);
        return $this->sendResponse($star_rating, 'Star Rating');
    }

    public function items_show(Request $request)
    {
        $items = StarRatingItem::where('active', true)->get();
        $is_rating = StarRating::is_rating_user_offer($request->user_id, $request->offer_id);
        if($is_rating){
            return $this->sendResponse([], 'Items');
        } else {
            return $this->sendResponse($items, 'Items');
        }
    }

    public function storeStarRating(Request $request)
    {
        $user_id = $request->input('user_id');
        $offer_id = $request->input('offer_id');
        $input_items_checkbox = $request->input('input_items_checkbox');
        $rating = $request->input('rating');
        $comment = $request->input('comment');
        if($rating > 3){
            $comment = "";
        }
        $star_rating = new StarRating();
        $star_rating->user_id = $user_id;
        $star_rating->offer_id = $offer_id;
        $star_rating->rating = $rating;
        $star_rating->comment = $comment;
        $star_rating->created_by = $user = $request->user()->id;
        $star_rating->save();

        if(!is_null($input_items_checkbox)){
            $star_rating->star_rating_items_selected()->sync($input_items_checkbox);
        }

        return $this->sendResponse($star_rating, 'Rating');
    }


}
