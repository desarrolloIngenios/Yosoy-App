<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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
        // 'Accept' => 'application/json',
        // 'Authorization' => 'Bearer '.$accessToken,
        return redirect()->route('profile.get');
    }

    public function registro_index()
    {
        return view('singup');
    }

    public function registro_post(Request $request)
    {
        $response = Http::accept('application/json')->post(route('api.register'), $request->input());
        //sdd($response->json());
        // if(!\Illuminate\Support\Arr::has($response->json(), 'success')){
        //     return redirect()->back()->withInput($request->all())->with('status', 'El Correo electrónico ya se encuentra en uso!');
        // }
        $success = $response->json()['success'];
        if(!$success){
            return redirect()->back()->withInput($request->all())->with('status', 'El Correo electrónico ya se encuentra en uso!');
        }
        //return dd($success);
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        if($success){
            return redirect()->route('login')->with('success', 'Cuenta creada con éxito, Puedes Iniciar Sesión!');
        }
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
            return redirect()->back()->with('success', 'Revisa tu bandeja de entrada para continuar el proceso');
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



}
