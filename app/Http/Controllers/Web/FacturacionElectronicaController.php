<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferQuestionResponse;
use App\Models\OfferQuestionStar;
use App\Models\OfferQuestionText;
use App\Models\Empresa;
use App\Models\WompiTransaccion;
use App\Models\ZenSmartFacturaElectronica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacturacionElectronicaController extends Controller
{

    public function index(Request $request)
    {   
        

        // Se revisan cuales transferencias no tienen factura electrónica
        //ZenSmartFacturaElectronica::
        $transacciones_por_factura = WompiTransaccion::where('is_factura_electronica', false)->where('estado_wompi', 'LIKE', 'APPROVED')->get();
        foreach($transacciones_por_factura as $transaccion){
            $empresa = $transaccion->user->empresa;
            //dd((int)str_replace(',','',$transaccion->valor_wompi));
            $valor = (int)str_replace(',','',$transaccion->valor_wompi)+0;
            ///$valor = 70000;
            $respuesta_factura_electronica = $this->facturaElectronica($empresa->id, $transaccion->id, (int)$valor);
            // la factura fue creada
            if($respuesta_factura_electronica){
                // Se guarda el registro en la tabla de zansmart de factura electronica
                $zensmart_factura = new ZenSmartFacturaElectronica();
                $zensmart_factura->empresa_id = $empresa->id;
                $zensmart_factura->wompi_transacion_id = $transaccion->id;
                $zensmart_factura->object = $respuesta_factura_electronica;
                $zensmart_factura->is_factura_enviada_correctamente = true;
                $zensmart_factura->save();
                // se actualiza el campo is_factura_enviada_correctamente 
                $transaccion->is_factura_electronica = true;
                $transaccion->save();
                Log::info('Se guarda el registro de la factura electrónica en la tabla de ZenSmartFacturaElectronica');
            }
            
            //Log::info($empresa->id);
            //Log::info($respuesta_factura_electronica);
        }
        dd($transacciones_por_factura);

       
        //$this->facturaElectronica($access_token, 15);
        return $access_token;

    }

    public function facturaElectronica($empresa_id, $transaction_wompi_id, $total = 0)
    {
        try{
            $url = "http://testing.eba-mnikdhzz.us-east-1.elasticbeanstalk.com./electronicbilling";

            if(env('APP_ENV') == 'production'){
                //$url = "https://production.wompi.co/v1/transactions?=2023-07-01&page=1&page_size=50&order_by=created_at&order=DESC";
            }

            $empresa = Empresa::with('regimen', 'actividad_economica', 'tipo_documento')->where('id', $empresa_id)->first();
            $validacion_empresa = $this->crearEmpresaZenSmart($empresa->id);
            if(!$validacion_empresa){
                Log::info('facturaElectronica '.$empresa->id.' no pasa la validacion de la creación de la empresa. No se puede generar factura.');
                return false;
            }

            $fecha_actual = \Carbon\Carbon::now()->isoFormat('YYYY-DD-MM');
            //dd($fecha_actual);
            $total = $total + 0;
            $transaction_wompi_id += 1000;
            $data =  [
                "prefix" => [
                      "id" => 1 
                   ], 
                "number" => $transaction_wompi_id.'', 
                "client" => [
                        "documentType" => [
                           "code" => $empresa->tipo_documento->zensmart_codigo
                        ], 
                        "identificationNumber" => $empresa->nit
                      ], 
                "paymentType" => [
                               "code" => "1" 
                            ], 
                "date" => $fecha_actual, 
                "expiration" => $fecha_actual, 
                "concept" => "Test", 
                "subTotal" => $total, 
                "items" => [
                                  [
                                     "product" => [
                                        "code" => "TEST2" 
                                     ], 
                                     "quantity" => 1, 
                                     "unitValue" => $total 
                                  ] 
                               ], 
                "total" => (int) $total*1.19, 
                "currency" => [
                                           "code" => "COP" 
                                        ], 
                "exchangeRate" => "1" 
             ]; 
             //dd($data);
             $access_token = $this->getAccessToken();
             if(is_null($access_token)){
                 Log::info("Error al obtener el token");
                 return false;
             }
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$access_token,
                'X-CLIENT-DB' => '118',
            ])->withBody(json_encode($data), 'application/json')->post($url);
            //dd($response->json());

            if($response->json('description') == "Success"){
                Log::info('FACTURA ELECTRÓNICA CREADA');
                Log::info('VALOR='.$total.' EMPRESA='.$empresa->id);
                //++ GUARDAR LA RESPUESTA EN BASE DE DATOS
                $object = $response->json('object');
                return $object;
            } else {
                Log::info('FACTURA ELECTRÓNICA NO PUDO SER CREADA');
                $object = $response->json();
                Log::info($object);
                return false;
            }
            dd($response->json());
        } catch (\Exception $e) {
            $text = "Error servicio Zensmart";
            Log::info($text);
        }
        return false;
    }


    public function crearEmpresaZenSmart($empresa_id)
    {
        //$empresa = Empresa::where('user_id', $user_id)->first();
        $empresa = Empresa::with('regimen', 'actividad_economica', 'tipo_documento')->where('id', $empresa_id)->first();
        $verificacion = $this->verificarEmpresaCreadaEnZendSmart($empresa);

        // Si no pasa la verificación, es porque no está la empresa creada.
        if($verificacion){
            Log::info('LA EMPRESA ESTÁ CREADA');
            Log::info('$empresa->id '.$empresa->id);
            Log::info('$empresa->nit '.$empresa->nit);
            return true;
        }

        // La empresa no está creada
        try{
            $url = "http://testing.eba-mnikdhzz.us-east-1.elasticbeanstalk.com./enterprises";

            if(env('APP_ENV') == 'production'){
                //$url = "";
            }
            if(!is_null($empresa) &&
            !is_null($empresa->tipo_documento) && 
            !is_null($empresa->nit) && $empresa->nit != "" &&
            !is_null($empresa->digito_verificacion) &&
            !is_null($empresa->regimen) &&
            !is_null($empresa->actividad_economica) &&
            !is_null($empresa->actividad_economica_id) &&
            $empresa->direccion != "" &&
            $empresa->email_factura_electronica != "" &&
            $empresa->nombre != ""
            
            )
        {
        $data =  
            [
                "documentType" => [
                        "code" => $empresa->tipo_documento->zensmart_codigo,
                    ], 
                "identificationNumber" => $empresa->nit, 
                "checkDigit" => $empresa->digito_verificacion, 
                "regime" => [
                            "name" => $empresa->regimen->nombre
                        ], 
                "country" => [
                            "code" => "CO" 
                            ], 
                "activity" => [
                                "ciiu219" => $empresa->actividad_economica->ciiu219
                            ], 
                "address" => $empresa->direccion, 
                "postalCode" => "0000", 
                "firstName" => $empresa->nombre, 
                "secondName" => "", 
                "lastName" => "", 
                "surName" => "", 
                "email" => $empresa->email_factura_electronica 
             ];          
             //dd($data);        
        } else {
            Log::info('no se puede crear la empresa falta información');
            Log::info('$empresa->id '.$empresa->id);
            Log::info('$empresa->nit '.$empresa->nit);
            return false;
        }
        $access_token = $this->getAccessToken();
        if(is_null($access_token)){
            Log::info("Error al obtener el token");
            return false;
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$access_token,
            'X-CLIENT-DB' => '118',
        ])->withBody(json_encode($data), 'application/json')->post($url);
        $description = $response->json('description');
        if($description == "The entered document number already exists"){
            Log::info($description);
            Log::info('$empresa->id '.$empresa->id);
            Log::info('$empresa->nit '.$empresa->nit);
            //dd($description);   
        }
        if($description == "Success"){
            Log::info('Empresa Creada: '.$description);
            Log::info('$empresa->id '.$empresa->id);
            Log::info('$empresa->nit '.$empresa->nit);
            //dd($description);
        }

        } catch (\Exception $e) {
            $text = "Error servicio Zensmart";
            Log::info($text);
            Log::info($e);
            //dd($e);
            return false;
        }
        return true;
        //dd($empresa);
    }

    public function verificarEmpresaCreadaEnZendSmart($empresa)
    {
        $access_token = $this->getAccessToken();
        if(is_null($access_token)){
            dd("Error obtener token");
        }

        try {
            // PRIMERO SE BUSCA SI LA EMPRESA YA HA SIDO CREADA EN EL SISTEMA DE ZENDSMART
            $url = "http://testing.eba-mnikdhzz.us-east-1.elasticbeanstalk.com./enterprise-rest?search=".$empresa->nit."&rowsPerPage=100&page=0";
            if(env('APP_ENV') == 'production'){
                //$url = "";
            }
            
            $data = [];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$access_token,
                'X-CLIENT-DB' => '118',
            ])->withBody(json_encode($data), 'application/json')->get($url);

            // SE LA RESPUESTA DEL SERVICIO ES SUCCESS
            if($response->json('description') == "Success"){
                $respuesta = $response->json('object');
                // SE VERIFICA LA CANTIDAD DE REGISTROS QUE RETORNA EL SERVICIO
                if(isset($respuesta['properties']) && isset($respuesta['properties']['records'])){

                    // SE SE OBTIENE MÀS DE UN REGISTRO SE DEBE VERIFICAR QUE EL TIPO DE DOCUMENTO Y EL DOCUMENTO 
                    // COINCIDAN CON EL QUE ESTÁ ALMACENADO EN LA PLATAFORMA
                    if((int) $respuesta['properties']['records'] > 0){
                        if(isset($respuesta['itemsDataTable'])){
                            foreach($respuesta['itemsDataTable'] as $item){
                                if(isset($item['documentType']) && isset($item['documentType']['code']) && isset($item['identificationNumber'])){
                                    // SE BUSCA EL CODIGO DEL DOCUMENTO DE IDENTIDAD Y LA IDENTIFICACIÓN
                                    $tipo_documento = $item['documentType']['code'];
                                    $identificacion = $item['identificationNumber'];
                                    if($tipo_documento == $empresa->tipo_documento->zensmart_codigo && $identificacion == $empresa->nit){
                                        return true;
                                    }
                                }
                            }
                            return true;
                        }
                    }
                }
            } 
            return false;
        } catch (\Exception $e) {
            dd("Error: Consulta");
            return false;
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
            Log::info($e);
            return null;
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
