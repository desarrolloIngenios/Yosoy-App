<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Base\Cargo;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfilePerfilLaboral;
use Validator;
use App\Models\Base\TiempoExperiencia;
use App\Models\Base\NivelExperiencia;
use App\Models\Code;




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

    /**
     * Login web
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $response = Http::accept('application/json')->post(route('api.login'), [
            'email' => $email,
            'password' => $password,
        ]);
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        if(!$success){
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error al acceder a la cuenta!');
        }
        $token = $data['token'];
        $request->session()->forget('token');
        session(['token' => $token]);  
        
        $role = $data['role'];
        $request->session()->forget('role');
        session(['role' => $role]);  

        $user_id = $data['user_id'];
        $request->session()->forget('user_id');
        session(['user_id' => $user_id]);  

        if($role == 'EMPRESARIO') {
            session(['empresa' => $data['empresa']]);  
        }
        // 'Accept' => 'application/json',
        // 'Authorization' => 'Bearer '.$accessToken,
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

        } else {
            return redirect()->route('registro_tipo_usuario.get');
        }

        $tiempo_experiencia = TiempoExperiencia::all();
        $nivel_experiencia = NivelExperiencia::all();
        $cargos = Cargo::orderBy('nombre')->get();

        $data['cargos'] = $cargos;
        $data['tiempo_experiencia'] = $tiempo_experiencia;
        $data['nivel_experiencia'] = $nivel_experiencia;

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
            'numero_contacto_1' => 'required',
            //'c_password' => 'required|same:password',
        ], ['email.unique' => "El correo ya está registrado"]);
   
        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        
        // Creación del Usuario
        $user = User::create($input);

        // Guardar Perfil
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
        }

        // si en el formulario viene el campo is_empresario verdadero, 
        // se asigna el rol de empresario al Usuario
        if($input['is_empresario'] == 1){
            $user->setRoleEmpresario();
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



}
