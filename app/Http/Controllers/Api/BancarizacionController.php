<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base\Bancarizacion;

class BancarizacionController extends BaseController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancarizacion = Bancarizacion::all();
        return $this->sendResponse($bancarizacion, 'Bancarizacion');

    }
}
