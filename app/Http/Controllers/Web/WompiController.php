<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferQuestionResponse;
use App\Models\OfferQuestionStar;
use App\Models\OfferQuestionText;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WompiController extends Controller
{
    public function index(Request $request)
    {   
        try{

        $response = Http::withToken("prv_test_zy1gktgC1z2SSY084g2yNeM6NOJshJT3")->accept('*/*')->get("https://sandbox.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC", 
                        [
                            'from_date' => '2020-07-01', 
                            'until_date' =>'2023-01-01',
                            'page' => 1,
                            'page_size' => 200
                        ]);
        } catch (\Exception $e) {
            dd("Error servicio wompi");
        }
                
        $error = $response->json('error');

        if($error){
            $type = $error['type'];
            $messages = $error['messages'];
            $text_errors = '';
            foreach($messages as $key => $values){
                $text_errors .= $key.": ";
                foreach($values as $value){
                    $text_errors .= $value.", ";
                }
                $text_errors .= "\n";
            }
            dd($text_errors);
        }
        $data = $response->json('data');
        $objs_transactions = [];
        if($data){
            foreach($data as $transaction_array){
                $transaction = (object) $transaction_array; 
                $objs_transactions[] = $transaction;
            }
        }
        $data = [
            'transactions' => $objs_transactions,
        ];
        return view('wompi/index', $data);


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
