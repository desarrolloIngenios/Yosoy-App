<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.candidato_index'), []);

        if (isset($response->json()['success'])) {
            $success = $response->json()['success'];
            $candidatas = $response->json()['data'];
            $message = $response->json()['message'];



            $data['candidatas'] = $candidatas;
            // dd($data);

            return view('candidato/index', $data);
        } else {
            return view('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index_lideresas(Request $request)
    {
        $data = [];
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.candidato_index_lideresas'), []);

        if (isset($response->json()['success'])) {
            $success = $response->json()['success'];
            $candidatas = $response->json()['data'];
            $message = $response->json()['message'];

            // FILTRO: Estado de perfil (completo/incompleto)
            $filtro_perfil = request('filtro_perfil');
            if ($filtro_perfil === 'completo') {
                $candidatas = array_filter($candidatas, function ($c) {
                    return isset($c['profile']) && !empty($c['profile']) && !empty($c['profile']['full_name']) && !empty($c['profile']['numero_documento']) && !empty($c['profile']['ciudad_residencia_id']);
                });
            } elseif ($filtro_perfil === 'incompleto') {
                $candidatas = array_filter($candidatas, function ($c) {
                    return !isset($c['profile']) || empty($c['profile']) || empty($c['profile']['full_name']) || empty($c['profile']['numero_documento']) || empty($c['profile']['ciudad_residencia_id']);
                });
            }

            // FILTRO: Mes de registro
            $filtro_mes = request('filtro_mes');
            if (!empty($filtro_mes)) {
                $candidatas = array_filter($candidatas, function ($c) use ($filtro_mes) {
                    if (!isset($c['created_at'])) return false;
                    $mes = \Carbon\Carbon::parse($c['created_at'])->format('Y-m');
                    return $mes === $filtro_mes;
                });
            }

            $data['candidatas'] = array_values($candidatas); // Asegura que sea un array indexado
            // dd($data);

            return view('candidato/index', $data);
        } else {
            return view('login');
        }
    }
}
