<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

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

        $profile = $request->user()->profile;

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
            $profile->educaciones = $profile->educaciones()->with(['nivel_educativo', 'titulo_educativo', 'ciudad', 'institucion_educativa'])->get();
        } else {
            $profile = new Profile();
            $profile->educaciones = [];
        }
        $profile->is_complete_form = $profile->is_complete_form();
        return $this->sendResponse($profile, 'Perfil');
    }


    

}
