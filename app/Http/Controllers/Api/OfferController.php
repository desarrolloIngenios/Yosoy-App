<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\ProfilePerfilLaboral;
use Illuminate\Support\Facades\Auth;


class OfferController extends BaseController
{

    public function index(Request $request)
    {
       
        $offers = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato']);
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

    public function get_available_offer(Request $request)
    {
       //$avalible_offers = 0;
       $avalible_offers = 1;
        return $this->sendResponse($avalible_offers, 'avalible_offers');
    }


    public function close_offer(Request $request, $offer_id)
    {
        $offer = Offer::find($offer_id);
        $offer->active = false;
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
