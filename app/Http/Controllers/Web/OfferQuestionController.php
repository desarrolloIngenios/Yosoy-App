<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferQuestionResponse;
use App\Models\OfferQuestionStar;
use App\Models\OfferQuestionText;

class OfferQuestionController extends Controller
{
    public function create(Request $request, $offer_id)
    {   

        //dd(\Session::all());
        $offer = Offer::find($offer_id);

        $star = OfferQuestionStar::all();
        $text = OfferQuestionText::all();

        $data = [
            'offer' => $offer,
            'question_star' => $star,
            'question_text' => $text,
        ];
        return view('offer/question/create', $data);

    }

    public function store(Request $request)
    {

        $offer_id = $request->input('offer_id');

        $star_ids = $request->input('star_ids');
        foreach($star_ids as $star_id){
            $star_response = $request->input('star_response_'.$star_id);
            $question_star = OfferQuestionStar::find($star_id);
            if(!is_null($star_response) &&  !is_null($question_star)){
                $offer_response = new OfferQuestionResponse();
                $offer_response->created_by = 1;
                $offer_response->offer_id = $offer_id;
                $offer_response->star_response = $star_response;
                $offer_response->text_response = "";
                $question_star->offerQuestions()->save($offer_response);
                $offer_response->save();
            }
        }

        $text_ids = $request->input('text_ids');
        $text_response = $request->input('text_response');
        foreach($text_ids as $key => $text_id){
            $question_text = OfferQuestionText::find($text_id);
            if(!is_null($question_text) && isset($text_response[$key])){
                $offer_response = new OfferQuestionResponse();
                $offer_response->created_by = 1;
                $offer_response->offer_id = $offer_id;
                $offer_response->text_response = $text_response[$key];
                $question_text->offerQuestions()->save($offer_response);
                $offer_response->save();
            }
        }

        return redirect()->back();
    }

    public function show(Request $request)
    {
        $offer_question_response = OfferQuestionResponse::all();
        $star = OfferQuestionStar::all();
        $text = OfferQuestionText::all();
        $data = [
            'offer_question_response' => $offer_question_response->groupBy(['offer_id', 'offer_question_type']),
            'question_star' => $star,
            'question_text' => $text,
        ];
        return view('offer/question/index', $data);

    }
}
