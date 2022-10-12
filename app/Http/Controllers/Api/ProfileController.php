<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfilePerfilLaboral;
use Illuminate\Support\Facades\Auth;


class ProfileController extends BaseController
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$user_id = $request->input('user_id');
        //$profile = Profile::where('user_id', $user_id)->first();
        $profile = $request->user()->profile;
        //return $request->user()->id;
        //return $request->except(['_token']);
       // dd($profile);
        if(is_null($profile)){
            $profile = new Profile();
        }
        $profile->fill($request->except(['_token']));
        $profile->user_id = $request->user()->id;
        $profile->pais_residencia_id = 0;
        $profile->save();
        return $this->sendResponse($profile, 'Perfil');
    }

    public function show(Request $request)
    {
        //return $request->user();
        //return \Auth::user();
        //return $request;
        //\Log::debug(print_r($request));
        //dd($request->body());
        $profile = $request->user()->profile;
        
        //$profile = Profile::find(1);
        //dd(Auth::user());
        if(!is_null($profile)){
            $profile->perfiles_laborales = $profile->perfiles_laborales()->with(['cargo', 'nivel_experiencia', 'tiempo_experiencia'])->get();
            $profile->experiencias_laborales = $profile->experiencias_laborales()->with(['cargo', 'sector', 'pais', 'ciudad'])->get();
            $profile->educaciones = $profile->educaciones()->with(['nivel_educativo', 'titulo_educativo', 'ciudad', 'institucion_educativa'])->get();
        } else {
            $profile = new Profile();
            $profile->perfiles_laborales = [];
            $profile->experiencias_laborales = [];
            $profile->educaciones = [];
        }
        $profile->is_complete_form = $profile->is_complete_form();
        return $this->sendResponse($profile, 'Perfil');
    }

    public function storePerfilLaboral(Request $request)
    {
        $profile = $request->user()->profile;
        //dd(Auth::user());

        //$profile = Profile::find(1);
        $profile->perfiles_laborales;

        $perfil_laboral = new ProfilePerfilLaboral();
        $perfil_laboral->fill($request->except(['_token']));
        $perfil_laboral->profile_id = $profile->id;
        $perfil_laboral->save();

        $profile->perfiles_laborales;
        
        return $this->sendResponse($profile, 'Perfil');
        //$profile = Profile::where('user_id', $user_id)->first();
        //return $this->sendResponse($profile, 'Perfil');
    }

    public function deletePerfilLaboral(Request $request, $id)
    {

        $perfil_laboral = ProfilePerfilLaboral::find($id);
        $perfil_laboral->delete();
        
        return $this->sendResponse([], 'Perfil Laboral Eliminado');
        //$profile = Profile::where('user_id', $user_id)->first();
        //return $this->sendResponse($profile, 'Perfil');
    }

    

}
