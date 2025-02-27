<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends BaseController
{

    public function index()
    {
        $bancos = Banco::all();
        return $this->sendResponse($bancos, 'bancos');
    }
}
