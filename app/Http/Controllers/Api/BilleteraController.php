<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billetera;
use Illuminate\Http\Request;

class BilleteraController extends BaseController
{

    public function index()
    {
        $billeteras = Billetera::all();
        return $this->sendResponse($billeteras, 'billeteras');
    }
}
