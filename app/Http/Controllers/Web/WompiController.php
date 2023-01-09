<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferQuestionResponse;
use App\Models\OfferQuestionStar;
use App\Models\OfferQuestionText;
use App\Models\WompiTransaccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WompiController extends Controller
{
    public function index(Request $request)
    {   
        $objs_transactions = $this->llamado_transacciones_wompi();
        $data = [
            'transactions' => $objs_transactions,
        ];
        return view('wompi/index', $data);

    }

    public function llamado_transacciones_wompi()
    {
        try{
            $token = "prv_test_zy1gktgC1z2SSY084g2yNeM6NOJshJT3";
            $url = "https://sandbox.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC";

            if(env('APP_ENV') == 'production'){
                $token = "prv_prod_X1hCA6QNAlpXJ9chFs1FuyNIJikt4SZ8";
                $url = "https://production.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC";
            }
            $response = Http::withToken($token)->accept('*/*')->get($url, 
                        [
                            'from_date' => '2020-07-01', 
                            'until_date' =>'2024-01-01',
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
        return $objs_transactions;
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

    public function store_datos_transaccion(Request $request)
    {
        $referencia = $request->get('referencia');
        $user_id = $request->get('user_id');
        
        $transaccion = WompiTransaccion::where('referencia', $referencia)->first();
        if(is_null($transaccion)){
            $transaccion = new WompiTransaccion();
            $transaccion->referencia = $referencia;
            $transaccion->user_id = $user_id;
            $transaccion->save();
        }
        return $transaccion;
    }

    public function actualizar_tabla_transacciones($user_id = null)
    {
        if(!is_null($user_id)){
            $transacciones_sin_confirmacion = WompiTransaccion::where('user_id', $user_id)->get();
        } else {
            $transacciones_sin_confirmacion = WompiTransaccion::whereNull('transaccion_wompi_id')->get();
        }
        // APPROVED
        $objs_transactions = $this->llamado_transacciones_wompi();
        //dd($transacciones_sin_confirmacion);
        //dd($transacciones_sin_confirmacion->get(['referencia']));

        $referencias = [];
        foreach($transacciones_sin_confirmacion as $transaccion){
            $referencias[] = $transaccion->referencia;
        }
        foreach ($objs_transactions as $transaccion) {
        //dd($transaccion->reference, $referencias);

            if(in_array($transaccion->reference, $referencias)){
                $wompi_transacion = $transacciones_sin_confirmacion->where('referencia', $transaccion->reference)->first();
                if(!is_null($wompi_transacion)){

                    $wompi_transacion->transaccion_wompi_id = $transaccion->id;
                    $wompi_transacion->estado_wompi = $transaccion->status;
                    $wompi_transacion->valor_wompi = number_format($transaccion->amount_in_cents/100);
                    $wompi_transacion->fecha_wompi = \Carbon\carbon::createFromFormat("Y-m-d\TH:i:s.uP",  $transaccion->created_at);
                    $wompi_transacion->save();
                }
            }
            //dd($transaccion->reference);
        }
      
        return $transaccion;
    }

    
}
