<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProgramController extends Controller
{

    // public function index()
    // {
    //     $client = new Client();
    //     $response = $client->post(config('suonos.base_url').'business/api/v1/shows/get_shows', [
    //         'json' => [
    //             'organization_code'=> "YOSOY"
    //         ],  
    //         'headers' => [
    //             'Authorization' => 'Token ' .config('suonos.token'),
    //             'Content-Type' => 'application/json',
    //             'Accept' => 'application/json',  
    //         ]
    //         ]);
    //     $data['programas'] = json_decode($response->getBody(), true);
        
        
    //     return view('program/index', $data);
        
    // }
    public function index()
    {
        try {
            $client = new Client();
            $response = $client->post(config('suonos.base_url') . 'business/api/v1/shows/get_shows', [
                'json' => ['organization_code' => "YOSOY"],
                'headers' => [
                    'Authorization' => 'Token ' . config('suonos.token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ]);
            $data['programas'] = json_decode($response->getBody(), true);
            return view('program/index', $data);

        } catch (\Exception $e) {
            Log::error('Error en ProgramController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudieron cargar los programas.');
        }
    }

    public function asignar_candidato(Request $request)
    {
        $user = User::find($request->user_id);
        $client = new Client(); 

        $response1 = $client->post(config('suonos.base_url').'business/api/v1/get_user/'.$user->email, [
            'json' => [
                'organization_code'=> "YOSOY",
            ],  
            'headers' => [
                'Authorization' => 'Token ' .config('suonos.token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',  
            ]
            ]);
        $data = json_decode($response1->getBody(), true);

     

        $key = array_search($request->program_id, array_column($data['shows'], 'show__id'));

        if ($key !== false) {
            return response()->json([
                'error' => true,
                'message' => 'El usuario ya tiene asignado el programa seleccionado',
            ]);

        } else {
            
            try {
                $response = $client->post(config('suonos.base_url').'business/api/v1/shows/set_subscription/'.$request->program_id, [
                    'json' => [
                        'organization_code'=> "YOSOY",
                        'user_email'=>$user->email
                    ],  
                    'headers' => [
                        'Authorization' => 'Token ' .config('suonos.token'),
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',  
                    ]
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Programa asignado con éxito.',
                    ]);
            } catch (\Exception $e) {
                
                return response()->json([
                    'success' => false,
                    'message' => 'Hubo un error al asignar el programa. ' . $e->getMessage(),
                ]);
            }
        }

        
        
        
    }


    public function index_candidato()
    {
        $user = User::find(session('user_id'));

        if ($user) {
            try {
                $client = new Client();

                $response1 = $client->post(config('suonos.base_url') . 'business/api/v1/get_user/' . $user->email, [
                    'json' => ['organization_code' => "YOSOY"],
                    'headers' => [
                        'Authorization' => 'Token ' . config('suonos.token'),
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]
                ]);

                $data1 = json_decode($response1->getBody(), true);

                $response2 = Http::withToken(session('token'))->get(route('api.profile'));
                $perfil = $response2->json()['data'];

                return view('suonos', [
                    'programas' => $data1['shows'],
                    'user' => $user,
                    'perfil' => $perfil,
                ]);

            } catch (\Exception $e) {
                Log::error('Error en ProgramController@index_candidato: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al cargar datos del candidato.');
            }
        }

        return view('login');
    }

    public function candidato($id){

        $user = User::find($id);

        
        if($user){
            $client = new Client();
            $response = $client->post(config('suonos.base_url').'business/api/v1/get_user/'.$user->email, [
                'json' => [
                    'organization_code'=> "YOSOY",
                ],  
                'headers' => [
                    'Authorization' => 'Token ' .config('suonos.token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',  
                ]
                ]);
            $data = json_decode($response->getBody(), true);

            $response2 = $client->post(config('suonos.base_url').'business/api/v1/shows/get_shows', [
                'json' => [
                    'organization_code'=> "YOSOY"
                ],  
                'headers' => [
                    'Authorization' => 'Token ' .config('suonos.token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',  
                ]
                ]);
            $data['programas'] = json_decode($response2->getBody(), true);
            
            return response()->json(['programas' => $data['shows'], 'programas_disponible' =>$data['programas'] ],200);
            
        }else{
            return response()->json(['programas' => "No se encuentra el usuario"],400);
        }
    

    }
}