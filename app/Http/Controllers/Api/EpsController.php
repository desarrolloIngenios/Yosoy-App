<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eps;
use App\Http\Controllers\Api\BaseController;

class EpsController extends BaseController
{
    public function index()
    {
        $eps = \App\Models\Eps::orderBy('nombre')->get();
        return $this->sendResponse($eps, 'eps');
    }
}
