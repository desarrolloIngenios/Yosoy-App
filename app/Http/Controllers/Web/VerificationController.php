<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificarCorreo;

class VerificationController extends Controller
{
    /**
     * Mostrar la página de notificación de verificación
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Verificar el correo del usuario
     */
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Verificar que el hash coincida con el email del usuario
        if (!hash_equals((string) $hash, sha1($user->email))) {
            return redirect()->route('login')->with('status', 'El enlace de verificación no es válido.');
        }

        // Si el email ya está verificado
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Tu correo ya ha sido verificado. Puedes iniciar sesión.');
        }

        // Marcar el email como verificado
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('login')->with('success', '¡Tu correo ha sido verificado exitosamente! Ya puedes iniciar sesión.');
    }

    /**
     * Reenviar el correo de verificación
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return back()->with('status', 'Tu correo ya ha sido verificado.');
        }

        Mail::to($user->email)->send(new VerificarCorreo($user));

        return back()->with('status', '¡Se ha enviado un nuevo enlace de verificación a tu correo!');
    }
}
