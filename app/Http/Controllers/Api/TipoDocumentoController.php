<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Base\TipoDocumento;


class TipoDocumentoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_documentos = TipoDocumento::all();
        return $this->sendResponse($tipo_documentos, 'Tipo Documentos');

    }
}
