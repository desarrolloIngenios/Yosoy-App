<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;

class EmpresaController extends Controller
{
        public function index(Request $request)
        {
 
            $data = [];
            $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.empresa_index'), []);
            //dd($response->json());
            $success = $response->json()['success'];
            $empresas = $response->json()['data'];
            $message = $response->json()['message'];
            $data['empresas'] = $empresas;
    
            return view('empresa/index', $data);
    }

   
}
