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
use App\Models\Code;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificarCorreo;

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
        // Validar si el usuario existe y si ha verificado su correo
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {

            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('status', 'El correo electrónico no está registrado.');
        }

        if ($user->email_verified_at == null && $user->created_at < '2026-01-13 00:00:00') {
            $user->email_verified_at = now();
            $user->save();
        }


        if ($user && is_null($user->email_verified_at)) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('status', 'Debes verificar tu correo electrónico antes de iniciar sesión. Por favor revisa tu bandeja de entrada.');
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $response = Http::accept('application/json')->post(route('api.login'), [
            'email' => $email,
            'password' => $password,
        ]);



        $jsonResponse = $response->json();

        if (!$response->successful() || !isset($jsonResponse['success'])) {
            Log::error('API Login Error: ' . $response->body());
            $errorMessage = isset($jsonResponse['message']) ? $jsonResponse['message'] : 'Hubo un problema al conectar con el servidor.';
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al acceder a la cuenta! ' . $errorMessage);
        }

        $success = $jsonResponse['success'];
        $data = $jsonResponse['data'] ?? [];


        if (!$success) {
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al acceder a la cuenta!' . $response->json()['message']);
        }


        $token = $data['token'];
        session(['token' => $token]);


        $role = $data['role'];

        session(['role' => $role]);

        if ($role == 'LIDERESA' ||  $role == '') {
            try {

                $client = new Client();
                $response1 = $client->post(config('suonos.base_url') . 'business/api/v1/get_user/' . $request->email, [
                    'json' => [
                        'organization_code' => "YOSOY",
                    ],
                    'headers' => [
                        'Authorization' => 'Token ' . config('suonos.token'),
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ]
                ]);
                $data1 = json_decode($response1->getBody(), true);
                // dd($data1);

                if (empty($data1)) {
                    $user = User::where('email', $request->email)->first();
                    $response = $client->post(config('suonos.base_url') . 'business/api/v1/create_account', [
                        'json' => [
                            'email' => $request->email,
                            'country' => 'Colombia',
                            'name' => $user->name,
                            'password' => $request->password,
                            'organization_code' => "YOSOY"

                        ],
                        'headers' => [
                            'Authorization' => 'Token ' . config('suonos.token'),
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ]
                    ]);
                }
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }

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


        return redirect()->route('profile.get');
    }
    public function registro_index(Request $request, $tipo_usuario = null)
    {
        $data = [];
        if ($tipo_usuario == 'tecnico') {

            $data['nombre'] = 'Técnico';
            $data['is_empirico'] = false;
        } elseif ($tipo_usuario == 'empirico') {

            $data['nombre'] = 'Empírico / Informal';
            $data['is_empirico'] = true;
        } elseif ($tipo_usuario == 'lideresa') {

            $data['nombre'] = 'Lideresa';
            $data['is_empirico'] = false;
        } else {
            return redirect()->route('registro_tipo_usuario.get');
        }

        $data['lideresas'] = User::with('roles', 'profile')->whereHas('roles', function ($query) {
            $query->where('name', 'LIDERESA');
        })->get();


        $data['lideresas'] = $data['lideresas']->map(function ($user) {
            $fullName = trim($user->profile->name . ' ' . $user->profile->last_name);

            if ($fullName === 'Daniela Nez') {
                $user->category = 1;
                $user->fullname = $user->profile->name . ' ' . $user->profile->last_name;
            } else {
                $user->category = null;
                $user->fullname = $user->profile->name . ' ' . $user->profile->last_name;
            }

            return $user;
        });


        $data['cargos'] = Cargo::orderBy('nombre')->get();
        $data['tiempo_experiencia'] = [];
        $data['nivel_experiencia'] = [];


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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'numero_contacto_1' => 'required'
        ], ['email.unique' => "El correo ya está registrado"]);

        if ($validator->fails()) {
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

            if ($profile->code) {
                $code = Code::set_used($profile->code);
            }

            // El token de Passport es opcional en el flujo web. Se envuelve en try-catch 
            // para que si Passport no está configurado, el proceso continúe.
            try {
                $user->createToken('MyApp')->accessToken;
            } catch (\Exception $e) {
                Log::warning('No se pudo crear el token de Passport en registro web: ' . $e->getMessage());
            }


            if ($input['is_empresario'] != 1) {
                // $perfil_laboral = new ProfilePerfilLaboral();
                // $perfil_laboral->fill($request->except(['_token']));
                // $perfil_laboral->profile_id = $profile->id;
                // $perfil_laboral->save();

                try {

                    $client = new Client();

                    $response = $client->post(config('suonos.base_url') . 'business/api/v1/create_account', [
                        'json' => [
                            'email' => $request->email,
                            'country' => 'Colombia',
                            'name' => $request->name,
                            'password' => $request->password,
                            'organization_code' => "YOSOY"

                        ],
                        'headers' => [
                            'Authorization' => 'Token ' . config('suonos.token'),
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ]
                    ]);
                } catch (\Throwable $th) {
                    Log::error($th);
                }
            }
            if ($request->has('is_lideresa')) {
                $user->setRoleLidereza();
            }
            if ($input['is_empresario'] == 1) {
                $user->setRoleEmpresario();
            }

            // Enviar correo de verificación
            try {
                Mail::to($user->email)->send(new VerificarCorreo($user));
            } catch (\Exception $e) {
                Log::error('Error al enviar correo de verificación: ' . $e->getMessage());
            }

            // DB::commit();

        } catch (\Exception $e) {
            Log::error('Error crítico en el registro de usuario: ' . $e->getMessage());
            return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Hubo un error al crear la cuenta. Por favor intenta de nuevo.']);
        }

        return redirect()->route('login')->with('success', 'Cuenta creada con éxito. Por favor verifica tu correo electrónico para activar tu cuenta.');
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
        $jsonResponse = $response->json();
        $success = $jsonResponse['success'] ?? false;
        $data = $jsonResponse['data'] ?? [];
        $message = $jsonResponse['message'] ?? '';

        if ($message == "passwords.sent") {
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
