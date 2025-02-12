<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base\Ciudad;

class CiudadController extends Controller
{
    public function index()
    {
        $ciudades = Ciudad::all();
        return response()->json($ciudades);
    }
}
