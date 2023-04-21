<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\DescuentosOfertas;


class PricingController extends Controller
{
    public function index(Request $request)
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

        return view('pricing/index', $data);
    }

}
