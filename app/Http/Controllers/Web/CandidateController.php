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

        if(isset($response->json()['success'])){
            $success = $response->json()['success'];
            $candidatas = $response->json()['data'];
            $message = $response->json()['message'];
    
            
            $data['candidatas'] = $candidatas;
            
            return view('candidato/index', $data);
        }else{
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

        if(isset($response->json()['success'])){
            $success = $response->json()['success'];
            $candidatas = $response->json()['data'];
            $message = $response->json()['message'];
    
            
            $data['candidatas'] = $candidatas;
            
            return view('candidato/index', $data);
        }else{
            return view('login');
        }
    }

  
}
