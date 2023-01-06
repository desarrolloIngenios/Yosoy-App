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
use Illuminate\Support\Facades\Log;

class FacturacionElectronicaController extends Controller
{
    public function index(Request $request)
    {   
        $access_token = $this->getAccessToken();
        if(is_null($access_token)){
            dd("Error obtener token");
        }
        $this->facturaElectronica($access_token);
        return $access_token;

    }

    public function facturaElectronica($access_token)
    {
        try{
            $url = "http://testing.eba-mnikdhzz.us-east-1.elasticbeanstalk.com./electronicbilling";

            if(env('APP_ENV') == 'production'){
                //$url = "https://production.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC";
            }

            $data =  [
                "prefix" => [
                      "id" => 1 
                   ], 
                "number" => "10", 
                "client" => [
                        "documentType" => [
                           "code" => "31" 
                        ], 
                        "identificationNumber" => "6263213" 
                      ], 
                "paymentType" => [
                               "code" => "1" 
                            ], 
                "date" => "2021-31-03", 
                "expiration" => "2021-31-03", 
                "concept" => "Test", 
                "subTotal" => 1000, 
                "items" => [
                                  [
                                     "product" => [
                                        "code" => "TEST2" 
                                     ], 
                                     "quantity" => 1, 
                                     "unitValue" => 1000 
                                  ] 
                               ], 
                "total" => 1190, 
                "currency" => [
                                           "code" => "COP" 
                                        ], 
                "exchangeRate" => "1" 
             ]; 

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$access_token,
                'X-CLIENT-DB' => '118',
            ])->withBody(json_encode($data), 'application/json')->post($url);
            dd($response->json());
        } catch (\Exception $e) {
            $text = "Error servicio Zensmart";
            Log::info($text);
        }
    }

    public function getAccessToken()
    {
        try{
            $url = "http://testing.eba-mnikdhzz.us-east-1.elasticbeanstalk.com./oauth/token";

            if(env('APP_ENV') == 'production'){
                //$url = "https://production.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC";
            }
            $response = Http::withHeaders([
                'Authorization' => 'Basic aW5nZW5pb3MtY2xpZW50OnY0NFpkWCVDRmtoZFYlJEg=',
            ])->accept('*/*')->asForm()->post($url, 
                        [
                            'grant_type' => 'password', 
                            'username' => 'Otoniel.fonseca@ingenios.com.co', 
                            'password' => 'Admin123!', 
                            'scope' => 'apiclient', 
                            'type' => 'NORMAL', 
                        ]);
        } catch (\Exception $e) {
            $text = "Error servicio Zensmart";
            Log::info($text);
        }

        if(!is_null($response->json('error')))
        {
            $text_errors = "Error: ";
            if($response->json('error_description')){
                $text_errors .= $response->json('error') . ' - ';
                $text_errors .= $response->json('error_description');
            }
            Log::info($text_errors);
            return null;
        }
        $data = $response->json('data');
        $access_token = $response->json('access_token');

        return $access_token;
    }

}
