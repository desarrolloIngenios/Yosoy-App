<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Billetera;
use Illuminate\Http\Request;

class BilleteraController extends BaseController
{

    public function index()
    {
        $billeteras = Billetera::get();
        return $this->sendResponse($billeteras, 'billeteras');
    }
}
