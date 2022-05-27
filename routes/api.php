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
if(env('API_FLAG')){

Route::post('register', [App\Http\Controllers\Api\LoginController::class, 'register'])->name('api.register');
Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login'])->name('api.login');
Route::post('forgot_password.post', [App\Http\Controllers\Api\LoginController::class, 'forgot_password'])->name('forgot_password.post');
Route::post('/reset-password', [App\Http\Controllers\Api\LoginController::class, 'reset_password'])->middleware('guest')->name('password.update');

Route::get('offer/public/{id}', [App\Http\Controllers\Api\OfferController::class, 'show_public'])->name('api.offer.show_public');

Route::middleware('auth:api')->group(function () {

    Route::post('pais', [App\Http\Controllers\Api\PaisController::class, 'index'])->name('api.pais');
    Route::post('genero', [App\Http\Controllers\Api\GeneroController::class, 'index'])->name('api.genero');
    Route::post('tipo_documentos', [App\Http\Controllers\Api\TipoDocumentoController::class, 'index'])->name('api.tipo_documentos');
    Route::post('ciudades', [App\Http\Controllers\Api\CiudadController::class, 'index'])->name('api.ciudades');
    Route::post('profile_post', [App\Http\Controllers\Api\ProfileController::class, 'store'])->name('api.profile_post');
    Route::get('profile', [App\Http\Controllers\Api\ProfileController::class, 'show'])->name('api.profile');
    Route::get('cargos', [App\Http\Controllers\Api\CargoController::class, 'index'])->name('api.cargos');
    Route::get('tiempo_experiencia', [App\Http\Controllers\Api\TiempoExperienciaController::class, 'index'])->name('api.tiempo_experiencia');
    Route::get('nivel_experiencia', [App\Http\Controllers\Api\NivelExperienciaController::class, 'index'])->name('api.nivel_experiencia');
    Route::get('tipo_contrato', [App\Http\Controllers\Api\TipoContratoController::class, 'index'])->name('api.tipo_contrato');
    Route::get('sector', [App\Http\Controllers\Api\SectorController::class, 'index'])->name('api.sector');
    Route::get('empleador', [App\Http\Controllers\Api\EmpleadorController::class, 'index'])->name('api.empleador');
    Route::get('nivel_educativo', [App\Http\Controllers\Api\NivelEducativoController::class, 'index'])->name('api.nivel_educativo');
    Route::get('titulo_educativo', [App\Http\Controllers\Api\TituloEducativoController::class, 'index'])->name('api.titulo_educativo');
    Route::get('institucion_educativa', [App\Http\Controllers\Api\InstitucionEducativaController::class, 'index'])->name('api.institucion_educativa');
    Route::get('user_list', [App\Http\Controllers\Api\UserController::class, 'index'])->name('api.user_list');
    
    Route::post('perfil_laboral', [App\Http\Controllers\Api\ProfileController::class, 'storePerfilLaboral'])->name('api.peril_labora_perfil.store');
    Route::delete('perfil_laboral/{id}', [App\Http\Controllers\Api\ProfileController::class, 'deletePerfilLaboral'])->name('api.peril_labora_perfil.delete');

    Route::post('experiencia_laboral', [App\Http\Controllers\Api\ExperienciaLaboralController::class, 'store'])->name('api.experiencia_laboral.store');
    Route::delete('experiencia_laboral/{id}', [App\Http\Controllers\Api\ExperienciaLaboralController::class, 'delete'])->name('api.experiencia_laboral.delete');

    Route::post('educacion', [App\Http\Controllers\Api\EducacionController::class, 'store'])->name('api.educacion.store');
    Route::delete('educacion/{id}', [App\Http\Controllers\Api\EducacionController::class, 'delete'])->name('api.educacion.delete');

    Route::post('offer/post', [App\Http\Controllers\Api\OfferController::class, 'store'])->name('api.offer.store');
    Route::get('offer/get', [App\Http\Controllers\Api\OfferController::class, 'index'])->name('api.offer.index');
    Route::get('offer/show/{offer_id}', [App\Http\Controllers\Api\OfferController::class, 'show'])->name('api.offer.show');
    Route::get('offer/get_profiles/apply/{offer_id}', [App\Http\Controllers\Api\OfferController::class, 'get_profile_apply'])->name('api.offer.profile.appply');

    

    Route::post('offer/apply', [App\Http\Controllers\Api\OfferController::class, 'apply'])->name('api.offer.apply');
    Route::get('offer/apply', [App\Http\Controllers\Api\OfferController::class, 'get_offers_apply'])->name('api.offer.apply.get');
    Route::get('offer/available', [App\Http\Controllers\Api\OfferController::class, 'get_available_offer'])->name('api.get.available.offer');
  

    Route::post('empresa', [App\Http\Controllers\Api\CompanyController::class, 'store'])->name('api.empresa.store');

    
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
}
