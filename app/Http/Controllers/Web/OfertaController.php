<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OfertaController extends Controller
{
    public function create(Request $request)
    {   

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.offer.index'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $offers = $response->json()['data'];
        $message = $response->json()['message'];
        $data['offers'] = $offers;
        if(!empty($offers) && count($offers) >= 1){
            return redirect()->route('pricing.index');
        }

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.get.available.offer'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $avalible_offers = $response->json()['data'];
        $message = $response->json()['message'];
        $data = [];
        if($avalible_offers == 0){
            return redirect()->route('pricing.index');
        }

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.cargos'));
        //dd($response->json());
        $success = $response->json()['success'];
        $cargos = $response->json()['data'];
        $message = $response->json()['message'];
        $data['cargos'] = $cargos;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.tiempo_experiencia'));
        //dd($response->json());
        $success = $response->json()['success'];
        $tiempo_experiencia = $response->json()['data'];
        $message = $response->json()['message'];
        $data['tiempo_experiencia'] = $tiempo_experiencia;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.sector'));
        // dd($response->json());
        $success = $response->json()['success'];
        $sector = $response->json()['data'];
        $message = $response->json()['message'];
        $data['sector'] = $sector;

        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.ciudades'), []);
        $success = $response->json()['success'];
        $ciudades = $response->json()['data'];
        $message = $response->json()['message'];
        $data['ciudades'] = $ciudades;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.nivel_educativo'));
        // dd($response->json());
        $success = $response->json()['success'];
        $nivel_educativo = $response->json()['data'];
        $message = $response->json()['message'];
        $data['nivel_educativo'] = $nivel_educativo;

        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.tipo_contrato'));
        // dd($response->json());
        $success = $response->json()['success'];
        $tipo_contrato = $response->json()['data'];
        $message = $response->json()['message'];
        $data['tipo_contrato'] = $tipo_contrato;

        return view('oferta/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input());
       
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
       // dd($offers_apply_ids);
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
        //$data['offers'] = [];
        //dd($data);
        return view('oferta/show', $data);
    }

}
