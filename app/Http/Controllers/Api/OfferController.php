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
        //dd($request);
        $offers = Offer::with(['cargo', 'sector', 'ciudad', 'nivel_educativo', 'tiempo_experiencia', 'tipo_contrato'])->get();
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

    // public function show(Request $request)
    // {
    //     //return $request->user();
    //     //return \Auth::user();
    //     //return $request;
    //     //\Log::debug(print_r($request));
    //     //dd($request->body());
    //     $profile = $request->user()->profile;
        
    //     //$profile = Profile::find(1);
    //     //dd(Auth::user());
    //     if(!is_null($profile)){
    //         $profile->perfiles_laborales = $profile->perfiles_laborales()->with(['cargo', 'nivel_experiencia', 'tiempo_experiencia'])->get();
    //         $profile->experiencias_laborales = $profile->experiencias_laborales()->with(['cargo', 'sector', 'pais', 'ciudad'])->get();
    //         $profile->educaciones = $profile->educaciones()->with(['nivel_educativo', 'titulo_educativo', 'ciudad', 'institucion_educativa'])->get();
    //     } else {
    //         $profile = new Profile();
    //         $profile->perfiles_laborales = [];
    //         $profile->experiencias_laborales = [];
    //         $profile->educaciones = [];
    //     }
    //     return $this->sendResponse($profile, 'Perfil');
    // }

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
