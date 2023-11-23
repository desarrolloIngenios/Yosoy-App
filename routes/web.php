<?php

use App\Http\Controllers\LexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if(env('WEB_FLAG')){


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [App\Http\Controllers\Web\LoginController::class, 'index'])->name('login');

Route::get('login_empresas', [App\Http\Controllers\Web\LoginController::class, 'index_empresas'])->name('login_empresas');
Route::post('login', [App\Http\Controllers\Web\LoginController::class, 'login'])->name('login.post');
Route::get('forgot', [App\Http\Controllers\Web\LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot', [App\Http\Controllers\Web\LoginController::class, 'forgot_post'])->name('forgot.post');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset_password', [App\Http\Controllers\Web\LoginController::class, 'reset_password'])->name('password.update.web');

Route::get('recordatorio_llenar_perfil/{user_id}', [App\Http\Controllers\Web\UserController::class, 'recordatorio_llenar_perfil'])->name('recordatorio_llenar_perfil');


Route::get('terminos_condiciones', [App\Http\Controllers\Web\PaginasEstaticasController::class, 'terminos_condiciones'])->name('terminos_condiciones');
Route::get('aviso_privacidad', [App\Http\Controllers\Web\PaginasEstaticasController::class, 'aviso_privacidad'])->name('aviso_privacidad');

Route::get('registro/{tipo_usuario?}', [App\Http\Controllers\Web\LoginController::class, 'registro_index'])->name('registro.get');
Route::post('registro', [App\Http\Controllers\Web\LoginController::class, 'registro_post'])->name('registro.post');
Route::get('registro_tipo_usuario', [App\Http\Controllers\Web\LoginController::class, 'registro_tipo_usuario'])->name('registro_tipo_usuario.get');


Route::get('registro_empresa', [App\Http\Controllers\Web\LoginController::class, 'registro_empresa'])->name('registro_empresa.get');
//Route::post('registro', [App\Http\Controllers\Web\LoginController::class, 'registro_post'])->name('registro.post');

Route::post('profile', [App\Http\Controllers\Web\ProfileController::class, 'store'])->name('profile.post');
Route::get('profile', [App\Http\Controllers\Web\ProfileController::class, 'index'])->name('profile.get');

Route::get('seleccionar_tipo_usuario', [App\Http\Controllers\Web\ProfileController::class, 'seleccionar_tipo_usuario'])->name('seleccionar_tipo_usuario.get');
Route::get('save_soy_tecnico.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_tecnico'])->name('save_soy_tecnico.get');
Route::get('save_soy_empirico.get', [App\Http\Controllers\Web\ProfileController::class, 'save_soy_empirico'])->name('save_soy_empirico.get');



Route::post('profile_laboral', [App\Http\Controllers\Web\PerfilLaboralController::class, 'store'])->name('profile_laboral.post');
Route::get('delete_perfil_laboral/{id}', [App\Http\Controllers\Web\PerfilLaboralController::class, 'delete'])->name('profile_laboral.delete');

Route::post('experiencia_laboral', [App\Http\Controllers\Web\ExperienciaLaboralController::class, 'store'])->name('experiencia_laboral.post');
Route::get('delete_experiencia_laboral/{id}', [App\Http\Controllers\Web\ExperienciaLaboralController::class, 'delete'])->name('experiencia_laboral.delete');

Route::post('educacion', [App\Http\Controllers\Web\EducacionController::class, 'store'])->name('educacion.post');
Route::get('delete_educacion/{id}', [App\Http\Controllers\Web\EducacionController::class, 'delete'])->name('educacion.delete');

Route::get('user/list', [App\Http\Controllers\Web\UserController::class, 'index'])->name('user_list');

Route::get('offer/index', [App\Http\Controllers\Web\OfertaController::class, 'index'])->name('offer.index');
Route::post('offer', [App\Http\Controllers\Web\OfertaController::class, 'store'])->name('offer.post');
Route::get('offer/public/{id}', [App\Http\Controllers\Web\OfertaController::class, 'show_public'])->name('offer.show_public');
Route::get('offer/apply/{offer_id}', [App\Http\Controllers\Web\OfertaController::class, 'apply'])->name('offer.apply');
Route::get('offer/detail/{offer_id}', [App\Http\Controllers\Web\OfertaController::class, 'show'])->name('offer.show');
Route::get('offer/close/{offer_id}', [App\Http\Controllers\Web\OfertaController::class, 'close_offer'])->name('offer.close');
Route::post('offer/contratar', [App\Http\Controllers\Web\OfertaController::class, 'contratar'])->name('offer.contratar');
Route::post('offer/garantia', [App\Http\Controllers\Web\OfertaController::class, 'garantia'])->name('offer.garantia');


//Route::post('profile', [App\Http\Controllers\Web\ProfileController::class, 'store'])->name('profile.post');
Route::get('oferta/create', [App\Http\Controllers\Web\OfertaController::class, 'create'])->name('oferta.create');
Route::get('oferta/create/copy/{copy_id}', [App\Http\Controllers\Web\OfertaController::class, 'create'])->name('oferta.create.copy');

Route::get('pricing/index/{tipo_candidato?}/{valor_ingresado?}', [App\Http\Controllers\Web\PricingController::class, 'index'])->name('pricing.index');
Route::post('pricing/edit/valor_pagar', [App\Http\Controllers\Web\PricingController::class, 'edit_valor_pagar'])->name('pricing.edit.valor_pagar');

Route::get('empresario/dashboard', [App\Http\Controllers\Web\CompanyController::class, 'dashboard'])->name('dashboard.empresario');
Route::get('empresario/empresa', [App\Http\Controllers\Web\CompanyController::class, 'empresa'])->name('empresa.empresario');
Route::post('empresa/create', [App\Http\Controllers\Web\CompanyController::class, 'empresa_post'])->name('empresa_create.post');
Route::post('empresa/update', [App\Http\Controllers\Web\CompanyController::class, 'empresa_update'])->name('empresa_update.post');
Route::get('empresa/index', [App\Http\Controllers\Web\EmpresaController::class, 'index'])->name('empresa.index');


Route::get('rating/{user_id}/offer/{offer_id}', [App\Http\Controllers\Web\StarRatingController::class, 'show'])->name('star_rating.show');
Route::post('rating_store', [App\Http\Controllers\Web\StarRatingController::class, 'store'])->name('star_rating.store');
Route::get('star_rating/index', [App\Http\Controllers\Web\StarRatingController::class, 'index'])->name('star_rating.index');


Route::get('logout', [App\Http\Controllers\Web\LoginController::class, 'logout'])->name('logout');

Route::get('generate_code', [App\Http\Controllers\Web\CodeController::class, 'generate_code'])->name('web.generate_codes');
Route::get('show_code', [App\Http\Controllers\Web\CodeController::class, 'show_code'])->name('web.show_codes');

Route::get('offer/questions/{offer_id}', [App\Http\Controllers\Web\OfferQuestionController::class, 'create'])->name('offer.question.create');
Route::get('offer/questions_show', [App\Http\Controllers\Web\OfferQuestionController::class, 'show'])->name('offer.questions.show');
Route::post('offer/questions', [App\Http\Controllers\Web\OfferQuestionController::class, 'store'])->name('offer.question.store');

Route::get('wompi/transactions', [App\Http\Controllers\Web\WompiController::class, 'index'])->name('wompi.index');

Route::get('offer/index/public', [App\Http\Controllers\Web\OfertaController::class, 'show_public_index'])->name('offer.show_public_index');
Route::get('offer/agragar/{user_id}/gratis/', [App\Http\Controllers\Web\OfertaController::class, 'agregar_oferta_gratis'])->name('offer.agregar_gratis');

Route::get('store_datos_transaccion', [App\Http\Controllers\Web\WompiController::class, 'store_datos_transaccion'])->name('store_datos_transaccion');

Route::post('aceptar_politicas', [App\Http\Controllers\Web\LoginController::class, 'aceptar_politicas'])->name('aceptar_politicas.post');


Route::get('facturacion/index', [App\Http\Controllers\Web\FacturacionElectronicaController::class, 'index'])->name('facturacion_electronica.index');
Route::get('facturacion/crearEmpresaZenSmart/{empresa_id}', [App\Http\Controllers\Web\FacturacionElectronicaController::class, 'crearEmpresaZenSmart'])->name('crearEmpresaZenSmart.index');





Route::get('/chatbot', function () {
    return view('chatbot.chatbot'); // Renderiza la vista del chatbot
});

Route::post('/lex-webhook', [App\Http\Controllers\LexController::class, 'webhook'])->name('webhook');


Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to(['juandavid162@gmail.com'])->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.index');

}

Route::post('image-upload', [App\Http\Controllers\Web\ProfileController::class, 'upload' ])->name('image.upload');