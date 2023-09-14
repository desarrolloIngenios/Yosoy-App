<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaginasEstaticasController extends Controller
{
    public function terminos_condiciones()
    {
        return view('paginas_estaticas/terminos_condiciones');
    }

    public function aviso_privacidad()
    {
        return view('paginas_estaticas/aviso_privacidad');
    }
}
