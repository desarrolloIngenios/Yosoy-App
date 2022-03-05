<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base\InstitucionEducativa;

class InstitucionEducativaController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones_educativas = InstitucionEducativa::orderBy('nombre')->get();
        return $this->sendResponse($instituciones_educativas, 'instituciones_educativas');

    }
}
