<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Base\Cargo;
use App\Models\User;
use App\Models\PoliticaLog;
use App\Models\PoliticaActual;
use App\Models\Profile;
use App\Models\ProfilePerfilLaboral;
use App\Models\Base\TiempoExperiencia;
use App\Models\Base\NivelExperiencia;
use App\Models\Code;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// use App\Rules\ReCaptcha;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function index_empresas()
    {
        return view('login_empresas');
    }
    public function login(Request $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');
        $response = Http::accept('application/json')->post(route('api.login'), [
            'email' => $email,
            'password' => $password,
        ]);
        
        $success = $response->json()['success'];
        $data = $response->json()['data'];

        if (!$success) {
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al acceder a la cuenta!');
        }

        $client = new Client(); 
        $response1 = $client->post(config('suonos.base_url').'business/api/v1/get_user/'.$request->email, [
            'json' => [
                'organization_code'=> "YOSOY",
            ],  
            'headers' => [
                'Authorization' => 'Token ' .config('suonos.token'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',  
            ]
            ]);
        $data1 = json_decode($response1->getBody(), true);


        if (empty($data1)) {
            $user = User::where('email',$request->email)->first();
            $response = $client->post(config('suonos.base_url').'business/api/v1/create_account', [
                'json' => [
                    'email' => $request->email,
                    'country' => 'Colombia',
                    'name' => $user->name,
                    'password' => $request->password,
                    'organization_code'=> "YOSOY"
                    
                ],  
                'headers' => [
                    'Authorization' => 'Token ' .config('suonos.token'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',  
                ]
                ]);
        } 
        
        

        $token = $data['token'];
        session(['token' => $token]);

        $role = $data['role'];
        session(['role' => $role]);

        $user_id = $data['user_id'];
        session(['user_id' => $user_id]);

        $politica_actual = PoliticaActual::find(1);
        $politica_log = PoliticaLog::where('user_id', $user_id)->where('version', $politica_actual->version)->first();

        $politica_aceptada = 0;
        if (!is_null($politica_log)) {
            $politica_aceptada = 1;
        }

        session(['politica_actual' => $politica_actual->version]);
        session(['user_politica_aceptada' => $politica_aceptada]);

        if ($role == 'EMPRESARIO') {
            session(['empresa' => $data['empresa']]);
        }

        return redirect()->route('profile.get');
    }
    public function registro_index(Request $request, $tipo_usuario = null)
    {
        $data = [];
        if($tipo_usuario == 'tecnico'){

            $data['nombre'] = 'Técnico';
            $data['is_empirico'] = false;

        } elseif($tipo_usuario == 'empirico') {

            $data['nombre'] = 'Empírico / Informal';
            $data['is_empirico'] = true;

        }elseif($tipo_usuario == 'lideresa') {

            $data['nombre'] = 'Lideresa';
            $data['is_empirico'] = false;

        }
         else {
            return redirect()->route('registro_tipo_usuario.get');
        }
        
        $data['lideresas'] = User::with('roles','profile') ->whereHas('roles', function($query) {$query->where('name', 'LIDERESA');})->get();
        $data['cargos'] = Cargo::orderBy('nombre')->get();
        $data['tiempo_experiencia'] = TiempoExperiencia::all();
        $data['nivel_experiencia'] = NivelExperiencia::all();

        return view('singup', $data);

    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->to('https://yo-soy.co');
        return redirect()->route('login');

    }
    public function registro_empresa()
    {
        return view('singup_empresa');
    }
    public function registro_post(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'numero_contacto_1' => 'required'
        ], ['email.unique' => "El correo ya está registrado"]);

        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }
        $input = $request->all();


        // Creación del Usuario
        // DB::beginTransaction();

        try {
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->pais_residencia_id = 0;
            $profile->fill($request->except(['_token']));
            $profile->save();

            if($profile->code){
                $code = Code::set_used($profile->code);
            }

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            

            if($input['is_empresario'] != 1){
                $perfil_laboral = new ProfilePerfilLaboral();
                $perfil_laboral->fill($request->except(['_token']));
                $perfil_laboral->profile_id = $profile->id;
                $perfil_laboral->save();

                $client = new Client();
                 // creacion de usuario en Sunos
                $response = $client->post(config('suonos.base_url').'business/api/v1/create_account', [
                    'json' => [
                        'email' => $request->email,
                        'country' => 'Colombia',
                        'name' => $request->name,
                        'password' => $request->password,
                        'organization_code'=> "YOSOY"
                        
                    ],  
                    'headers' => [
                        'Authorization' => 'Token ' .config('suonos.token'),
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',  
                    ]
                    ]);
            }
            if($request->has('is_lideresa')){
                    $user->setRoleLidereza();
            }
            if($input['is_empresario'] == 1){
                $user->setRoleEmpresario();
            }
        
           
            
            
            // DB::commit();

        } catch (\Exception $e) {
            // DB::rollBack();
            // dd($e->getMessage());
        }
            
        return redirect()->route('login')->with('success', 'Cuenta creada con éxito, Puedes Iniciar Sesión!');
    }
    public function forgot()
    {
        return view('forgot_password');
    }
    public function forgot_post(Request $request)
    {
        $email = $request->input('email');
        $response = Http::accept('application/json')->post(route('forgot_password.post'), [
            'email' => $email,
        ]);
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        if($message == "passwords.sent"){
            return redirect()->back()->with('success', 'Revisa tu bandeja de entrada para continuar el proceso. Si no logras encontrarlo, revisa tu bandeja de spam.');
        } else {
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al enviar el correo');
        }
    }
    public function reset_password(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');
        $response = Http::accept('application/json')->post(route('password.update'), [
            'email' => $email,
            'password' => $password,
            'token' => $token,
        ]);
        return redirect()->route('login')->with('success', 'Contraseña actualizada! Puedes inicar sesión de nuevo');
    }
    public function registro_tipo_usuario()
    {
        return view('registro_tipo_usuario');
    }
    public function aceptar_politicas(Request $request)
    {
        $input = $request->all();
        $politica_log = PoliticaLog::create($input);
        session(['user_politica_aceptada' => 1]);
    }
    public function suonos()
    {
        return view('suonos');
    }


}
