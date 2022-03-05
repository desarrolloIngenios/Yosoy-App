<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ExperienciaLaboralController extends Controller
{
    public function store(Request $request)
    {
        $is_actual = true;
        $fecha_inicio = $request->input('fecha_inicio');
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $fecha_inicio);
        $fecha_inicio = $date->format('Y-m-d 00:00:00');

        $fecha_fin = $request->input('fecha_fin');
        if(!is_null($fecha_fin)){
            $date = \Carbon\Carbon::createFromFormat('m/d/Y', $fecha_fin);
            $fecha_fin = $date->format('Y-m-d 00:00:00');
            $is_actual = false;
        }
        $request->merge([
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'is_actual' => $is_actual,
        ]);
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.experiencia_laboral.store'), $request->input());
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->delete(route('api.experiencia_laboral.delete', ['id' => $id]));
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    
}
