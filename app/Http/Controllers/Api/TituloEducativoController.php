<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base\TituloEducativo;


class TituloEducativoController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulo_educativo = TituloEducativo::all();
        return $this->sendResponse($titulo_educativo, 'titulo_educativo');
    }
}
