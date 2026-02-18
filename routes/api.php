<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//if(env('API_FLAG')){

Route::post('register', [App\Http\Controllers\Api\LoginController::class, 'register'])->name('api.register');
Route::post('validate_code', [App\Http\Controllers\Api\LoginController::class, 'validate_code'])->name('api.validate_code');
Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login'])->name('api.login');
Route::post('forgot_password.post', [App\Http\Controllers\Api\LoginController::class, 'forgot_password'])->name('forgot_password.post');
Route::post('/reset-password', [App\Http\Controllers\Api\LoginController::class, 'reset_password'])->middleware('guest')->name('password.update');



Route::middleware('auth:api')->group(function () {

    Route::post('pais', [App\Http\Controllers\Api\PaisController::class, 'index'])->name('api.pais');
    Route::post('genero', [App\Http\Controllers\Api\GeneroController::class, 'index'])->name('api.genero');
    Route::get('bancarizaciones', [App\Http\Controllers\Api\BancarizacionController::class, 'index'])->name('api.bancarizaciones');

    Route::post('tipo_documentos', [App\Http\Controllers\Api\TipoDocumentoController::class, 'index'])->name('api.tipo_documentos');
    Route::post('ciudades', [App\Http\Controllers\Api\CiudadController::class, 'index'])->name('api.ciudades');
    Route::post('profile_post', [App\Http\Controllers\Api\ProfileController::class, 'store'])->name('api.profile_post');
    Route::get('profile', [App\Http\Controllers\Api\ProfileController::class, 'show'])->name('api.profile');
    Route::get('cargos', [App\Http\Controllers\Api\CargoController::class, 'index'])->name('api.cargos');
    
    Route::get('tipo_contrato', [App\Http\Controllers\Api\TipoContratoController::class, 'index'])->name('api.tipo_contrato');
    Route::get('sector', [App\Http\Controllers\Api\SectorController::class, 'index'])->name('api.sector');
    
    Route::get('nivel_educativo', [App\Http\Controllers\Api\NivelEducativoController::class, 'index'])->name('api.nivel_educativo');
    Route::get('titulo_educativo', [App\Http\Controllers\Api\TituloEducativoController::class, 'index'])->name('api.titulo_educativo');
    Route::get('institucion_educativa', [App\Http\Controllers\Api\InstitucionEducativaController::class, 'index'])->name('api.institucion_educativa');
    Route::get('user_list', [App\Http\Controllers\Api\UserController::class, 'index'])->name('api.user_list');

    

    

    Route::post('educacion', [App\Http\Controllers\Api\EducacionController::class, 'store'])->name('api.educacion.store');
    Route::delete('educacion/{id}', [App\Http\Controllers\Api\EducacionController::class, 'delete'])->name('api.educacion.delete');

    


    

    


    Route::get('generate_codes', [App\Http\Controllers\Api\CodeController::class, 'generate_codes'])->name('api.generate_codes');

    Route::get('candidato_index', [App\Http\Controllers\Api\CandidateController::class, 'index'])->name('api.candidato_index');
    Route::get('candidato_index_lideresas', [App\Http\Controllers\Api\CandidateController::class, 'index_lideresas'])->name('api.candidato_index_lideresas');

    Route::get('bancos', [App\Http\Controllers\Api\BancoController::class, 'index'])->name('api.banco');
    Route::get('billetera', [App\Http\Controllers\Api\BilleteraController::class, 'index'])->name('api.billetera');
    Route::get('eps', [App\Http\Controllers\Api\EpsController::class, 'index'])->name('api.eps');

    // Mentee comments API
    Route::post('mentee-comments', [App\Http\Controllers\Api\MenteeCommentController::class, 'store'])->name('api.mentee_comments.store');
    Route::get('mentee-comments/{mentee}', [App\Http\Controllers\Api\MenteeCommentController::class, 'index'])->name('api.mentee_comments.index');
    Route::delete('mentee-comments/{id}', [App\Http\Controllers\Api\MenteeCommentController::class, 'destroy'])->name('api.mentee_comments.destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//}
