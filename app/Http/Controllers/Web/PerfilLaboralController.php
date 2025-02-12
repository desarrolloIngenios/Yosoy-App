<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PerfilLaboralController extends Controller
{
    public function store(Request $request)
    {
        
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.peril_labora_perfil.store'), $request->input());
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
       
        $response = Http::withToken(session('token'))->accept('application/json')->delete(route('api.peril_labora_perfil.delete', ['id' => $id]));
        
        

        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    
}
