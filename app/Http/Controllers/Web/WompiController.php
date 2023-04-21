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

    public function store_datos_transaccion(Request $request)
    {
        $referencia = $request->get('referencia');
        $user_id = $request->get('user_id');
        $cantidad_ofertas = $request->get('cantidad_ofertas');
        
        $transaccion = WompiTransaccion::where('referencia', $referencia)->first();
        if(is_null($transaccion)){
            $transaccion = new WompiTransaccion();
            $transaccion->referencia = $referencia;
            $transaccion->user_id = $user_id;
            $transaccion->cantidad_ofertas = $cantidad_ofertas;
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
