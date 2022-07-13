<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;


class UserController extends BaseController
{
    public function index()
    {
        $profile = Profile::with(
            'ciudad_residencia', 
            'genero', 
            'tipo_documento', 
            'perfiles_laborales.nivel_experiencia', 
            'perfiles_laborales.cargo',
            'perfiles_laborales.tiempo_experiencia',
            'user'
            )->get();
        //dd($profile);
        return $this->sendResponse($profile, 'profile');
    }
}
