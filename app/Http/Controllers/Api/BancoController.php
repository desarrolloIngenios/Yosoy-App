<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use Illuminate\Http\Request;

class BancoController extends BaseController
{

    public function index()
    {
        $bancos = Banco::get();
        return $this->sendResponse($bancos, 'bancos');
    }
}
