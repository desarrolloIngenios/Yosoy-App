<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileExperienciaLaboral;


class ExperienciaLaboralController extends BaseController
{
    
    public function store(Request $request)
    {
        $profile = $request->user()->profile;
        //$profile = Profile::find(1);
        $experiencia_laboral = new ProfileExperienciaLaboral();
        $experiencia_laboral->fill($request->except(['_token']));
        $experiencia_laboral->profile_id = $profile->id;
        $experiencia_laboral->pais_id = 0;
        $experiencia_laboral->empleador_id = 0;
        $experiencia_laboral->empleador = ucwords($request->input('empleador'));
        $experiencia_laboral->save();
        
        return $this->sendResponse($profile, 'Perfil');
    }

    public function delete(Request $request, $id)
    {
        $experiencia_laboral = ProfileExperienciaLaboral::find($id);
        $experiencia_laboral->delete();
        
        return $this->sendResponse([], 'Experiencia Laboral Eliminado');
    }

    

}
