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
Route::post('validate_code', [App\Http\Controllers\Api\LoginController::class, 'validate_code'])->name('api.validate_code');
Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login'])->name('api.login');
Route::post('forgot_password.post', [App\Http\Controllers\Api\LoginController::class, 'forgot_password'])->name('forgot_password.post');
Route::post('/reset-password', [App\Http\Controllers\Api\LoginController::class, 'reset_password'])->middleware('guest')->name('password.update');

Route::get('offer/public/{id}', [App\Http\Controllers\Api\OfferController::class, 'show_public'])->name('api.offer.show_public');
Route::get('offer/index_public', [App\Http\Controllers\Api\OfferController::class, 'show_public_index'])->name('api.offer.show_public_index');

Route::middleware('auth:api')->group(function () {

    Route::post('pais', [App\Http\Controllers\Api\PaisController::class, 'index'])->name('api.pais');
    Route::post('genero', [App\Http\Controllers\Api\GeneroController::class, 'index'])->name('api.genero');
    Route::get('bancarizaciones', [App\Http\Controllers\Api\BancarizacionController::class, 'index'])->name('api.bancarizaciones');
    
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
    Route::get('offer/close/{offer_id}', [App\Http\Controllers\Api\OfferController::class, 'close_offer'])->name('api.offer.close');
    Route::get('offer/get_profiles/apply/{offer_id}', [App\Http\Controllers\Api\OfferController::class, 'get_profile_apply'])->name('api.offer.profile.appply');
    Route::get('offer/get_profiles/for/{offer_id}', [App\Http\Controllers\Api\OfferController::class, 'get_profiles_for_offer'])->name('api.offer.profiles');

    
    Route::post('offer/apply', [App\Http\Controllers\Api\OfferController::class, 'apply'])->name('api.offer.apply');
    Route::get('offer/apply', [App\Http\Controllers\Api\OfferController::class, 'get_offers_apply'])->name('api.offer.apply.get');
    Route::get('offer/available', [App\Http\Controllers\Api\OfferController::class, 'get_available_offer'])->name('api.get.available.offer');
    Route::get('agregar_oferta_prueba/{user_id}', [App\Http\Controllers\Api\OfferController::class, 'agregar_oferta_prueba'])->name('api.offer.agregar_oferta_prueba');
    

    Route::post('empresa', [App\Http\Controllers\Api\CompanyController::class, 'store'])->name('api.empresa.store');
    Route::post('empresa/update', [App\Http\Controllers\Api\CompanyController::class, 'update'])->name('api.empresa.update');
    Route::get('empresa/index', [App\Http\Controllers\Api\CompanyController::class, 'index'])->name('api.empresa_index');
    Route::get('empresa/find/{id}', [App\Http\Controllers\Api\CompanyController::class, 'find'])->name('api.empresa.find');

    Route::get('star_rating/user_api', [App\Http\Controllers\Api\StarRatingController::class, 'star_rating_by_user'])->name('api.star_rating');
    Route::get('items/show', [App\Http\Controllers\Api\StarRatingController::class, 'items_show'])->name('api.items_show');
    Route::post('star_rating/store', [App\Http\Controllers\Api\StarRatingController::class, 'storeStarRating'])->name('api.star_rating_store');
    Route::get('star_rating/index', [App\Http\Controllers\Api\StarRatingController::class, 'index'])->name('star_rating_show.index');


    Route::get('generate_codes', [App\Http\Controllers\Api\CodeController::class, 'generate_codes'])->name('api.generate_codes');

    Route::get('candidato_index', [App\Http\Controllers\Api\CandidateController::class, 'index'])->name('api.candidato_index');
    Route::get('candidato_index_lideresas', [App\Http\Controllers\Api\CandidateController::class, 'index_lideresas'])->name('api.candidato_index_lideresas');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
}
