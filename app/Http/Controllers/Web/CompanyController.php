<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = [];
        return view('empresa/dashboard_empresa', $data);
    }

    public function empresa(Request $request)
    {
        //dd(session('empresa'));
        $empresa_id = session('empresa');
       
        $data = [];
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.ciudades'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $ciudades = $response->json()['data'];
        $message = $response->json()['message'];
        $data['ciudades'] = $ciudades;

        if($empresa_id != ''){
            return view('empresa/edit', $data);
        } 
        
        return view('empresa/create', $data);
    }

    public function empresa_post(Request $request)
    {

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.empresa.store'), $request->input());
        $empresa = $response->json()['data'];
        if(session('role') == 'EMPRESARIO') {
            session(['empresa' => $empresa['id']]);  
        }
        //dd($response->json());
        //$success = $response->json()['success'];
        //$data = $response->json()['data'];
       // $message = $response->json()['message'];

        return redirect()->back();
        
    }
}
