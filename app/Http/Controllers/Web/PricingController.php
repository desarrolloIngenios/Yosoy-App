<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\DescuentosOfertas;


class PricingController extends Controller
{
    public function index(Request $request, $tipo_candidato = null, $valor_ingresado = 0)
    {
        $public_key_wompi = "pub_test_WFaWpZ8xYKWD8x0Vs713YNYADtuQePwL";
        if(env('APP_ENV') == 'production'){
            $public_key_wompi = "pub_prod_QVZBgzXWjsT1EuCDmzUWyyJKDyYdlvx9";
        }
        $data = [
            'public_key_wompi' => $public_key_wompi
        ];

        $descuentos = DescuentosOfertas::all();
        $precio_base = 75000;
        $data['descuentos'] = $descuentos;
        $data['precio_base'] = $precio_base;

        $data['tipo_candidato'] = $tipo_candidato;
        $data['empirico_valor'] = 50000;
        $data['tecnico_valor'] = 135000;
        $data['mensual'] = 500000;

        if($tipo_candidato == 'empirico' && $valor_ingresado > $data['empirico_valor']){
            $data['empirico_valor'] = $valor_ingresado;
        } else if($tipo_candidato == 'tecnico' && $valor_ingresado > $data['tecnico_valor']){
            $data['tecnico_valor'] = $valor_ingresado;
        } else if($tipo_candidato == 'mensual' && $valor_ingresado > $data['mensual']){
            $data['mensual'] = $valor_ingresado;
        }

        return view('pricing/index', $data);
    }

    function edit_valor_pagar(Request $request)
    {
        $valor_ingresado = $request->input('quantity');
        $tipo_candidato = $request->input('tipo_candidato');

        return redirect()->route('pricing.index',['tipo_candidato' => $tipo_candidato, 'valor_ingresado' => $valor_ingresado]);
    }

}
