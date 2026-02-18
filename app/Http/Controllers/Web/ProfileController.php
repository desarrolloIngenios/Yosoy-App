<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class ProfileController extends Controller
{

    public function validar_success($response)
    {
        if ($response && $response->successful()) {
            $json = $response->json();
            if (is_array($json) && isset($json['success']) && $json['success']) {
                return true;
            }
        }

        Log::error('API Error in ProfileController: ' . ($response ? $response->body() : 'No response'));
        return false;
    }

    public function index(Request $request)
    {
        ini_set('memory_limit', '300M');
        $minutes = 1800;

        if (session('role') ==  'EMPRESARIO') {
            return redirect()->route('dashboard.empresario');
        }

        if (!session('token', false)) {
            return redirect()->route('login');
        }
        //dd($debugInfo);
        $response = Http::withToken(session('token'))->get(route('api.profile'));
        $this->validar_success($response);
        $success = $response->json()['success'];
        $perfil = $response->json()['data'];
        $message = $response->json()['message'];
        $data['perfil'] = $perfil;
        if (!isset($perfil['is_empirico']) ||  is_null($perfil['is_empirico'])) {
            return redirect()->route('seleccionar_tipo_usuario.get');
        }

        if (Cache::has('paises')) {
            $paises = Cache::get('paises');
            $data['paises'] = $paises;
        } else {
            $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.pais'), []);
            $this->validar_success($response);
            $success = $response->json()['success'];
            $paises = $response->json()['data'];
            $message = $response->json()['message'];
            $data['paises'] = $paises;
            //$users = DB::table('users')->get();
            Cache::put('paises', $paises, $minutes);
        }

        if (Cache::has('generos')) {
            $generos = Cache::get('generos');
            $data['generos'] = $generos;
        } else {
            $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.genero'), []);
            //dd($response->json());
            $this->validar_success($response);
            $success = $response->json()['success'];
            $generos = $response->json()['data'];
            $message = $response->json()['message'];
            $data['generos'] = $generos;
            Cache::put('generos', $generos, $minutes);
        }

        // Cache de tipo_documentos
        if (Cache::has('tipo_documentos')) {
            $tipo_documentos = Cache::get('tipo_documentos');
            $data['tipo_documentos'] = $tipo_documentos;
        } else {
            $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.tipo_documentos'), []);
            $this->validar_success($response);
            $success = $response->json()['success'];
            $tipo_documentos = $response->json()['data'];
            $message = $response->json()['message'];
            $data['tipo_documentos'] = $tipo_documentos;
            Cache::put('tipo_documentos', $tipo_documentos, $minutes);
        }

        // Cache de ciudades
        // if (Cache::has('ciudades')) {
        //     $ciudades = Cache::get('ciudades');
        //     $data['ciudades'] = $ciudades;
        // } else {
        //     $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.ciudades'), []);
        //     $this->validar_success($response);
        //     $success = $response->json()['success'];
        //     $ciudades = $response->json()['data'];
        //     $message = $response->json()['message'];
        //     $data['ciudades'] = $ciudades;
        //     Cache::put('ciudades', $ciudades, $minutes);
        // }

        $cache_keys = [
            'bancarizaciones',
            'cargos',
            'tipo_contrato',
            'sector',
            'nivel_educativo',
            'titulo_educativo',
            'institucion_educativa',
            'banco',
            'billetera',
            'eps',
        ];




        foreach ($cache_keys as $key) {
            if (Cache::has($key)) {
                $data[$key] = Cache::get($key);
            } else {
                $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.' . $key));
                // dd($response->json());
                $this->validar_success($response);
                $success = $response->json()['success'];
                $data[$key] = $response->json()['data'];
                $message = $response->json()['message'];
                Cache::put($key, $data[$key], $minutes);
            }
        }
        // dd($data['billetera']);
        return view('profile/profile', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $fecha_nacimiento_sin_formato = $request->input('fecha_nacimiento');
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $fecha_nacimiento_sin_formato);
        $fecha_con_formato = $date->format('Y-m-d 00:00:00');

        $request->merge([
            'fecha_nacimiento' => $fecha_con_formato,
        ]);

        // Si selecciona 'ninguna', guardar null en eps y nombre_eps
        if ($request->input('eps') === 'ninguna') {
            $request->merge(['eps' => null, 'nombre_eps' => null]);
        }

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), $request->input());

        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];
        //dd($profile);

        if (!$success) {
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

    public function save_soy_lideresa(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), ['is_empirico' => false]);
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->route('profile.get');
    }

    public function save_soy_superlideresa(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.profile_post'), ['is_empirico' => false]);
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

        $image_name = time() . '.' . $request->image->extension();

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
