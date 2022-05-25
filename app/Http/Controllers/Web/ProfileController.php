<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        ini_set('memory_limit', '100M');

        if(session('role') ==  'EMPRESARIO'){
            return redirect()->route('dashboard.empresario');
        }

        $response = Http::withToken(session('token'))->get(route('api.profile'));
        //dd($response->json());
        $success = $response->json()['success'];
        $perfil = $response->json()['data'];
        $message = $response->json()['message'];
        $data['perfil'] = $perfil;
        if(!isset($perfil['is_empirico']) ||  is_null($perfil['is_empirico'])){
            return redirect()->route('seleccionar_tipo_usuario.get');
        }

        //dd(session('token'));
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.pais'), []);
        $success = $response->json()['success'];
        $paises = $response->json()['data'];
        $message = $response->json()['message'];
        $data['paises'] = $paises;


        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.genero'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $generos = $response->json()['data'];
        $message = $response->json()['message'];
        $data['generos'] = $generos;

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.tipo_documentos'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $tipo_documentos = $response->json()['data'];
        $message = $response->json()['message'];
        $data['tipo_documentos'] = $tipo_documentos;

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.ciudades'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $tipo_documentos = $response->json()['data'];
        $message = $response->json()['message'];
        $data['ciudades'] = $tipo_documentos;
        
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.cargos'));
        //dd($response->json());
        $success = $response->json()['success'];
        $cargos = $response->json()['data'];
        $message = $response->json()['message'];
        $data['cargos'] = $cargos;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.tiempo_experiencia'));
        //dd($response->json());
        $success = $response->json()['success'];
        $tiempo_experiencia = $response->json()['data'];
        $message = $response->json()['message'];
        $data['tiempo_experiencia'] = $tiempo_experiencia;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.nivel_experiencia'));
        //dd($response->json());
        $success = $response->json()['success'];
        $nivel_experiencia = $response->json()['data'];
        $message = $response->json()['message'];
        $data['nivel_experiencia'] = $nivel_experiencia;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.tipo_contrato'));
        // dd($response->json());
        $success = $response->json()['success'];
        $tipo_contrato = $response->json()['data'];
        $message = $response->json()['message'];
        $data['tipo_contrato'] = $tipo_contrato;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.sector'));
        // dd($response->json());
        $success = $response->json()['success'];
        $sector = $response->json()['data'];
        $message = $response->json()['message'];
        $data['sector'] = $sector;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.empleador'));
        // dd($response->json());
        $success = $response->json()['success'];
        $empleador = $response->json()['data'];
        $message = $response->json()['message'];
        $data['empleador'] = $empleador;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.nivel_educativo'));
        // dd($response->json());
        $success = $response->json()['success'];
        $nivel_educativo = $response->json()['data'];
        $message = $response->json()['message'];
        $data['nivel_educativo'] = $nivel_educativo;

        
        //dd($perfil);
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.titulo_educativo'));
        // dd($response->json());
        $success = $response->json()['success'];
        $titulo_educativo = $response->json()['data'];
        $message = $response->json()['message'];
        $data['titulo_educativo'] = $titulo_educativo;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.institucion_educativa'));
        // dd($response->json());
        $success = $response->json()['success'];
        $institucion_educativa = $response->json()['data'];
        $message = $response->json()['message'];
        $data['institucion_educativa'] = $institucion_educativa;

        return view('profile/profile', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_nacimiento_sin_formato = $request->input('fecha_nacimiento');
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $fecha_nacimiento_sin_formato);
        $fecha_con_formato = $date->format('Y-m-d 00:00:00');

        $request->merge([
            'fecha_nacimiento' => $fecha_con_formato,
        ]);

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), $request->input());
        //dd($response);

        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];
        //dd($profile);

        if(!$success){
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al acceder a la cuenta!');
        }
        return redirect()->back();
    }

    public function seleccionar_tipo_usuario(Request $request)
    {
        $data = [];
        return view('profile/seleccionar_tipo_usuario', $data);
    }

    public function save_soy_tecnico(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), ['is_empirico' => false]);
        //dd($response->json());

        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->route('profile.get');
        
    }

    public function save_soy_empirico(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), ['is_empirico' => true]);
        //dd($response->json());

        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->route('profile.get');
    }

    public function upload(Request $request)
    {
        //dd(\Session::all());

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $image_name = time().'.'.$request->image->extension();  
     
        $path = \Storage::disk('s3')->put('images', $request->image);
        // Guardar path en base de datos
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), ['foto_perfil_url' => $path]);
        //\Storage::disk('s3')->setVisibility($path, 'public');
        $path = \Storage::disk('s3')->url($path);
        //\Storage::disk('s3')->setVisibility($path, 'public');
        
        
       
    
        return redirect()->back()
            ->with('success', 'Image uploaded successfully.')
            ->with('image', $path); 
    }

    
    
}
