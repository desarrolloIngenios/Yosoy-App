<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Profile;
use App\Models\ProfilePerfilLaboral;
use App\Models\ProfileExperienciaLaboral;
use App\Models\WompiTransaccion;
use App\Models\OfertaGratis;


use Illuminate\Support\Facades\Auth;


class OfferController extends BaseController
{

    public function index(Request $request)
    {
       
        $offers = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato','empresa']);
        $user = $request->user();
        if(!is_null($user->roles->first()) && $user->roles->first()->name === 'EMPRESARIO'){
            if(!is_null($user->empresa)){

                $empresa_id =  $user->empresa->id;
                $offers = $offers->where('company_id', $empresa_id);
            } else {
                return $this->sendResponse([], 'Offers');
            }
        }
        $offers = $offers->orderBy('id', 'desc')->get();
        return $this->sendResponse($offers, 'Offers');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer = new Offer();
        //dd($request);
        $offer->fill($request->except(['_token']));
        $offer->save();
        $offer->tipo_contrato()->sync($request->input('tipo_contrato'));
        return $this->sendResponse($offer, 'Offer');
    }

    public function show_public(Request $request, $id)
    {
        $offer = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato'])->where('id', $id)->first();
        return $this->sendResponse($offer, 'Offer');
    }

    public function show_public_index(Request $request)
    {
        $offers = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato'])->where('active', true)->get();
        return $this->sendResponse($offers, 'Offer');
    }

    public function show(Request $request, $offer_id)
    {
        $offer = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato', 'users'])->where('id', $offer_id)->first();
       
        return $this->sendResponse($offer, 'Offer');
    }

    public function apply(Request $request)
    {
        $user = $request->user();
        $offer_id = $request->input('offer_id');
        $user->offers()->detach($offer_id);
        $user->offers()->attach($offer_id);
        return $this->sendResponse($user, 'Offer');
    }

    public function get_offers_apply(Request $request)
    {
        $user = $request->user();
        $offers = $user->offers()->get();
        return $this->sendResponse($offers, 'Offers');
    }

    public function get_profile_apply(Request $request, $offer_id)
    {
        $offer = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato', 'users'])->where('id', $offer_id)->first();
        $profiles = [];
        foreach($offer->users as $user){
            
            $profiles[] = $user->profile;
        }
        return $this->sendResponse($profiles, 'profiles');
    }

    public function get_profiles_for_offer(Request $request, $offer_id)
    {
        // se buscan perfiles que tengan el mismo cargo y que se encuentren en la ciudad de la oferta

        // SE CONSULTA LA OFERTA
        $offer = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato'])->where('id', $offer_id)->first();
        
        // EXPERIENCIAS QUE CORRESPONDEN CON EL CARGO Y EL TIEMPO DE EXPERIENCIA ES IGUAL O MAYOR AL REQUERIDO EN LA OFERTA
        $experiencias = ProfilePerfilLaboral::where('cargo_id', $offer->cargo->id)->where('tiempo_experiencia_id', '>=', $offer->tiempo_experiencia_id)->pluck('profile_id')->toArray();
        
        // SE OBTIEN LOS IDS DE LOS PERFILES LABORALES QUE COINCIDEN CON LA OFERTA
        $ids_of_profiles = array_unique($experiencias); 

        // SE OBTIENEN LOS PERFILES DE LOS CANDIDATOS QUE COINCIDEN CON LA BUSQUDA SOLICITADA SE AGREGA EL FILTRO DE LAS CIUDADES
        $profiles = Profile::whereIn('id', $ids_of_profiles)->where('ciudad_residencia_id', $offer->ciudad->id)
        ->with('user',
            'ciudad_residencia',
            'genero',
            'tipo_documento',
            'genero',
            'perfiles_laborales.nivel_experiencia',
            'perfiles_laborales.cargo',
            'perfiles_laborales.tiempo_experiencia'
      )->orderBy('updated_at', 'DESC')->limit(15)->get();

        return $this->sendResponse($profiles, 'profiles');
    }


    public function get_available_offer(Request $request)
    {
        $avalible_offers = 0;
        $empirico_count = 0;
        $tecnico_count = 0;

        // Se consulta la cantidad de ofertas pagas aprobadas tiene el usuario
        $cantidad_ofertas_pagas = WompiTransaccion::where('user_id', $request->user()->id)->where('estado_wompi', "LIKE", "APPROVED")->sum('cantidad_ofertas') + 0;
        // Se consulta la cantidad de ofertas gratuitas que tiene el usuario y se suman a las ofertas pagas
        $cantidad_ofertas_gratis = OfertaGratis::where('user_id', $request->user()->id)->sum('cantidad_ofertas');


        // se consultan la cantidad de ofertas publicadas
        $ofertas = Offer::where('user_id', $request->user()->id)->get();

        $cantidad_ofertas_realizadas = count($ofertas);

        $avalible_offers = $cantidad_ofertas_pagas + $cantidad_ofertas_gratis - $cantidad_ofertas_realizadas;


        if($cantidad_ofertas_pagas > $cantidad_ofertas_realizadas)
        {
            $ofertas_tecnicas_usadas = count($ofertas->where('is_tecnico',true));
            $ofertas_empirico_usadas = count($ofertas->where('is_empirico',true));

            $ofertas_pagas = WompiTransaccion::where('user_id', $request->user()->id)->where('estado_wompi', "LIKE", "APPROVED")->get();
            $ofertas_pagas_empirico = count($ofertas_pagas->where('tipo_candidato_string', '=', 'empirico'));
            $ofertas_pagas_tecnico = count($ofertas_pagas->where('tipo_candidato_string', '=', 'tecnico'));

            $tecnico_count = $ofertas_pagas_tecnico - $ofertas_tecnicas_usadas;
            $empirico_count = $ofertas_pagas_empirico - $ofertas_empirico_usadas;

        } elseif($cantidad_ofertas_realizadas < $cantidad_ofertas_pagas + $cantidad_ofertas_gratis){
            $tecnico_count = 1;
            $empirico_count = 1;
        } 
        
        if(!is_null($request->user()->roles->first()) && $request->user()->roles->first()->name === 'ADMIN')
        {
            $avalible_offers = 1;
            $empirico_count = 1;
            $tecnico_count = 1;
        }

        $obj = new \stdClass();
        $obj->avalible_offers = $avalible_offers;
        $obj->empirico = $empirico_count;
        $obj->tecnico = $tecnico_count;

        return $this->sendResponse($obj, 'data');
    }


    public function close_offer(Request $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        $offer->active = false;
        $offer->save();
        return $this->sendResponse($offer, 'Offer');
    }

    public function agregar_oferta_prueba(Request $request, $user_id)
    {
        $offer = new OfertaGratis();
        $offer->user_id = $user_id;
        $offer->save();
        return $this->sendResponse($offer, 'Offer');
    }

    

    
    

    // public function storePerfilLaboral(Request $request)
    // {
    //     $profile = $request->user()->profile;
    //     //dd(Auth::user());

    //     //$profile = Profile::find(1);
    //     $profile->perfiles_laborales;

    //     $perfil_laboral = new ProfilePerfilLaboral();
    //     $perfil_laboral->fill($request->except(['_token']));
    //     $perfil_laboral->profile_id = $profile->id;
    //     $perfil_laboral->save();

    //     $profile->perfiles_laborales;
        
    //     return $this->sendResponse($profile, 'Perfil');
    //     //$profile = Profile::where('user_id', $user_id)->first();
    //     //return $this->sendResponse($profile, 'Perfil');
    // }

    // public function deletePerfilLaboral(Request $request, $id)
    // {

    //     $perfil_laboral = ProfilePerfilLaboral::find($id);
    //     $perfil_laboral->delete();
        
    //     return $this->sendResponse([], 'Perfil Laboral Eliminado');
    //     //$profile = Profile::where('user_id', $user_id)->first();
    //     //return $this->sendResponse($profile, 'Perfil');
    // }

    

}
