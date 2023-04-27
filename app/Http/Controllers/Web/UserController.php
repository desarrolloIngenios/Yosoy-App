<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.user_list'), []);
        //dd($response->json());
        if(!is_null($response)){
            if (!array_key_exists('success', $response->json())) {
                // $debugInfo = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
                // Log::info($debugInfo);
                Log::info('Contenido de la sesión: ' . json_encode(session()->all()));
                Log::info("Método ".__METHOD__." en linea ".__LINE__);
                return redirect(\Request::url());
                //return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
        $success = $response->json()['success'];
        $users = $response->json()['data'];
        $message = $response->json()['message'];
        $data['users'] = $users;
        
        return view('users/list', $data);
    }


}
