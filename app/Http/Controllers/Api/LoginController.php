<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\PoliticaLog;
use App\Models\Code;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificarCorreo;

class LoginController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'numero_contacto_1' => 'required',
            //'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
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

        // Passport Token
        $success['name'] =  $user->name;
        $success['token'] = null;
        try {
            $success['token'] = $user->createToken('MyApp')->accessToken;
        } catch (\Exception $e) {
            \Log::warning('No se pudo crear el token de Passport en registro API: ' . $e->getMessage());
        }

        // si en el formulario viene el campo is_empresario verdadero, 
        // se asigna el rol de empresario al Usuario
        if (isset($input['is_empresario']) && $input['is_empresario'] == 1) {
            $user->setRoleEmpresario();
        }

        // Enviar correo de verificación
        try {
            Mail::to($user->email)->send(new VerificarCorreo($user));
        } catch (\Exception $e) {
            \Log::error('Error al enviar correo de verificación API: ' . $e->getMessage());
        }

        return $this->sendResponse($success, 'User register successfully. Please verify your email.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot_password(Request $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        $success = [];
        return $this->sendResponse($success, $status);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Verificar si el correo ha sido verificado
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return $this->sendError('Email not verified.', ['error' => 'Please verify your email before logging in.']);
            }

            $success['name'] =  $user->name;
            $success['user_id'] =  $user->id;
            $success['role'] =  $user->roles->first() ? $user->roles->first()->name : '';
            $success['token'] = null;

            try {
                $success['token'] = $user->createToken('MyApp')->accessToken;
            } catch (\Exception $e) {
                \Log::warning('No se pudo crear el token de Passport en login API: ' . $e->getMessage());
            }

            return $this->sendResponse($success, 'User login successfully.');
        } else {

            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function reset_password(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //dd("hola");
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function validate_code(Request $request)
    {
        $code = $request->code;
        if (!Code::is_used($code)) {
            return $this->sendResponse(true, 'Codigo.');
        }
        return $this->sendResponse(false, 'No valido');
    }
}
