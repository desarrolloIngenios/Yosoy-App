<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntrenamientoContoller extends Controller
{
    public function index(Request $request)
    {
        return view('suonos');
    }
    public function show_analitics()
    {
        return view('analitics');
    }
    public function show_analitics_yosoy()
    {
        return view('dashboard.index');
    }
    
}
