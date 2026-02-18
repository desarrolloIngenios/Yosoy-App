<?php

use App\Http\Controllers\LexController;
use App\Http\Controllers\Web\MenteeCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CiudadController;

//if(env('WEB_FLAG')){ #se debe comentar esta linea y la de cierre para que funcione en local logica x

Route::get('/health', function () {
    return response('OK', 200);
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [App\Http\Controllers\Web\LoginController::class, 'index'])->name('login');
Route::get('suonos', [App\Http\Controllers\Web\LoginController::class, 'suonos'])->name('suonos');

Route::post('login', [App\Http\Controllers\Web\LoginController::class, 'login'])->name('login.post');

Route::get('forgot', [App\Http\Controllers\Web\LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot', [App\Http\Controllers\Web\LoginController::class, 'forgot_post'])->name('forgot.post');
Route::get('lideresa', [App\Http\Controllers\Web\RoleController::class, 'create'])->name('rol.lideresa');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset_password', [App\Http\Controllers\Web\LoginController::class, 'reset_password'])->name('password.update.web');

// Rutas de verificación de correo
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Web\VerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::get('/email/verification-notice', [App\Http\Controllers\Web\VerificationController::class, 'notice'])
    ->name('verification.notice');

Route::post('/email/verification-notification', [App\Http\Controllers\Web\VerificationController::class, 'resend'])
    ->middleware(['throttle:6,1'])
    ->name('verification.resend');

Route::get('recordatorio_llenar_perfil/{user_id}', [App\Http\Controllers\Web\UserController::class, 'recordatorio_llenar_perfil'])->name('recordatorio_llenar_perfil');
Route::get('user_list', [App\Http\Controllers\Web\UserController::class, 'index'])->name('user_list');


Route::get('terminos_condiciones', [App\Http\Controllers\Web\PaginasEstaticasController::class, 'terminos_condiciones'])->name('terminos_condiciones');
Route::get('aviso_privacidad', [App\Http\Controllers\Web\PaginasEstaticasController::class, 'aviso_privacidad'])->name('aviso_privacidad');

Route::get('registro/{tipo_usuario?}', [App\Http\Controllers\Web\LoginController::class, 'registro_index'])->name('registro.get');
Route::post('registro', [App\Http\Controllers\Web\LoginController::class, 'registro_post'])->name('registro.post');
Route::get('registro_tipo_usuario', [App\Http\Controllers\Web\LoginController::class, 'registro_tipo_usuario'])->name('registro_tipo_usuario.get');




Route::post('profile', [App\Http\Controllers\Web\ProfileController::class, 'store'])->name('profile.post');
Route::get('profile', [App\Http\Controllers\Web\ProfileController::class, 'index'])->name('profile.get');

Route::get('seleccionar_tipo_usuario', [App\Http\Controllers\Web\ProfileController::class, 'seleccionar_tipo_usuario'])->name('seleccionar_tipo_usuario.get');
Route::get('save_soy_tecnico.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_tecnico'])->name('save_soy_tecnico.get');
Route::get('save_soy_empirico.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_empirico'])->name('save_soy_empirico.get');
Route::get('save_soy_lideresa.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_lideresa'])->name('save_soy_lideresa.get');
Route::get('save_soy_superlideresa.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_superlideresa'])->name('save_soy_superlideresa.get');






Route::post('educacion', [App\Http\Controllers\Web\EducacionController::class, 'store'])->name('educacion.post');
Route::get('delete_educacion/{id}', [App\Http\Controllers\Web\EducacionController::class, 'delete'])->name('educacion.delete');








//Route::post('profile', [App\Http\Controllers\Web\ProfileController::class, 'store'])->name('profile.post');










Route::get('logout', [App\Http\Controllers\Web\LoginController::class, 'logout'])->name('logout');

Route::get('generate_code', [App\Http\Controllers\Web\CodeController::class, 'generate_code'])->name('web.generate_codes');
Route::get('show_code', [App\Http\Controllers\Web\CodeController::class, 'show_code'])->name('web.show_codes');









Route::post('aceptar_politicas', [App\Http\Controllers\Web\LoginController::class, 'aceptar_politicas'])->name('aceptar_politicas.post');







Route::get('/chatbot', function () {
    return view('chatbot.chatbot'); // Renderiza la vista del chatbot
});

Route::post('/lex-webhook', [App\Http\Controllers\LexController::class, 'webhook'])->name('webhook');

Route::post('image-upload', [App\Http\Controllers\Web\ProfileController::class, 'upload'])->name('image.upload');

Route::get('candidates', [App\Http\Controllers\Web\CandidateController::class, 'index'])->name('candidate.index');
Route::get('candidates_lideresas', [App\Http\Controllers\Web\CandidateController::class, 'index_lideresas'])->name('candidate.index_lideresas');
Route::get('programas', [App\Http\Controllers\Web\ProgramController::class, 'index'])->name('program.index');
Route::get('entrenamiento/index', [App\Http\Controllers\Web\ProgramController::class, 'index_candidato'])->name('entrenamiento.index');
Route::get('candidato/{id}', [App\Http\Controllers\Web\ProgramController::class, 'candidato'])->name('entrenamiento.candidato.index');
Route::post('asignar-candidato', [App\Http\Controllers\Web\ProgramController::class, 'asignar_candidato'])->name('programa.candidato.index');


Route::middleware(['role:SUPERLIDERESA'])->group(function () {
    Route::get('analitics', [App\Http\Controllers\Web\EntrenamientoContoller::class, 'show_analitics'])->name('analitics.index');
    Route::get('dashboard', [App\Http\Controllers\Web\DashboardController::class, 'index'])->name('analitics.yosoy.index');
});

Route::get('/api/ciudades', [CiudadController::class, 'index']);

Route::post('mentee-comments', [MenteeCommentController::class, 'store']);
Route::get('mentee-comments/{mentee}', [MenteeCommentController::class, 'index']);
Route::delete('mentee-comments/{id}', [MenteeCommentController::class, 'destroy']);


// Diagnostic route to check session/auth status via AJAX
Route::get('debug/whoami', function () {
    return response()->json([
        'id' => auth()->id(),
        'user' => auth()->user(),
        'authenticated' => auth()->check(),
    ]);
});

//} #se debe comentar esta linea y la de apertura para que funcione en local logica x