<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\Web\WompiController;


class OfertaController extends Controller
{
    public function create(Request $request)
    {   
        $wompi_controller = new WompiController();
        if(session('role') == 'ADMIN'){
            $wompi_controller->actualizar_tabla_transacciones();
        } else {
            $wompi_controller->actualizar_tabla_transacciones(session()->get('user_id'));
        }


        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.index'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offers = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offers'] = $offers;

      //  dd(session()->all());

        // if(session('role') != 'ADMIN'){
        //     //if(!empty($offers) && count($offers) >= 2){
        //         return redirect()->route('pricing.index');
        //     //}
        // }


        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.get.available.offer'), []);
        // dd($response->json());
        $success = $response->json()['success'];
        $avalible_offers = $response->json()['data']['avalible_offers'];
        $empirico_count = $response->json()['data']['empirico'];
        $tecnico_count = $response->json()['data']['tecnico'];
        $message = $response->json()['message'];
        $data = [];
        $tipo_candidato_empirico = $empirico_count > 0 ? true : false;
        $tipo_candidato_tecnico = $tecnico_count > 0 ? true : false;
        
        $data['tipo_candidato_empirico'] = $tipo_candidato_empirico;
        $data['tipo_candidato_tecnico'] = $tipo_candidato_tecnico;
        //    dd($data);
        if($avalible_offers == 0){
            return redirect()->route('pricing.index');
        }

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.ciudades'), []);
        $success = $response->json()['success'];
        $ciudades = $response->json()['data'];
        $message = $response->json()['message'];
        $data['ciudades'] = $ciudades;

        $cache_keys = [
            'tipo_contrato',
            'nivel_educativo',
            'sector',
            'tiempo_experiencia',
            'cargos',
        ];
        
        $minutes = 1800;
        foreach ($cache_keys as $key) {
            if (Cache::has($key)) {
                $data[$key] = Cache::get($key);
            } else {
                $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.' . $key));
                $success = $response->json()['success'];
                $data[$key] = $response->json()['data'];
                $message = $response->json()['message'];
                Cache::put($key, $data[$key], $minutes);
            }
        }

        return view('oferta/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //dd($request->input('tipo_candidato'));
        if($request->input('tipo_candidato') == "tecnico"){
            $request->request->add(['is_tecnico' => true]);
        }
        if($request->input('tipo_candidato') == "empirico"){
            $request->request->add(['is_empirico' => true]);
        }
       
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.offer.store'), $request->input());
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];
       

        if(!$success){
            return redirect()->back()->withInput($request->only('email'))->with('status', 'Error!');
        }
        return redirect()->back();
    }

    public function index(Request $request)
    {
        $response = Http::withToken(session('token'))->get(route('api.profile'));
        //dd($response->json());
        $success = $response->json()['success'];
        $perfil = $response->json()['data'];
        $message = $response->json()['message'];
        $data['perfil'] = $perfil;
        
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.index'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offers = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offers'] = $offers;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.apply.get'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offers_apply = $response->json()['data'];
        $message = $response->json()['message'];
        $offers_apply_ids = [];
        foreach($offers_apply as $offer_apply){
            $offers_apply_ids[] = $offer_apply['id'];
        }
        //$data['offers'] = [];
        //dd($offers_apply_ids);
        $data['offers_apply_ids'] = $offers_apply_ids;

        return view('oferta/index', $data);
    }

    public function show_public(Request $request, $id)
    {
        //dd($id);
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.show_public', ['id' => $id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offer = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offer'] = $offer;
        //$data['offers'] = [];
        //dd($data);
        return view('oferta/show_public', $data);
    }

    public function show_public_index(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.show_public_index', ['id' => 1]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offer = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offers'] = $offer;
        return view('oferta/show_public_index', $data);
    }

    public function apply(Request $request, $offer_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.offer.apply'), ['offer_id' => $offer_id]);
        return redirect()->route('offer.index');
    }

    public function show(Request $request, $offer_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.show', ['offer_id' => $offer_id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offer = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offer'] = $offer;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.profile.appply', ['offer_id' => $offer_id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $profiles = $response->json()['data'];
        $message = $response->json()['message'];
        $data['users'] = $profiles;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.profiles', ['offer_id' => $offer_id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $profiles = $response->json()['data'];
        $message = $response->json()['message'];
        $data['users_busqueda'] = $profiles;

        return view('oferta/show', $data);
    }

    public function close_offer(Request $request, $offer_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.close', ['offer_id' => $offer_id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $profiles = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    public function agregar_oferta_gratis(Request $request, $user_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.agregar_oferta_prueba', ['user_id' => $user_id]), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $profiles = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }


}
