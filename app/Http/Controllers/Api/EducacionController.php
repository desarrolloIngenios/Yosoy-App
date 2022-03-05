<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileEducacion;


class EducacionController extends BaseController
{
    
    public function store(Request $request)
    {

        $profile = $request->user()->profile;
        //$profile = Profile::find(1);
        $educacion = new ProfileEducacion();
        $educacion->fill($request->except(['_token']));
        $educacion->profile_id = $profile->id;
        $educacion->save();
        
        return $this->sendResponse($profile, 'Perfil');
    }

    public function delete(Request $request, $id)
    {
        $educacion = ProfileEducacion::find($id);
        $educacion->delete();
        
        return $this->sendResponse([], 'Experiencia Laboral Eliminado');
    }

}
