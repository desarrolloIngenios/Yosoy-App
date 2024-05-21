<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        #echo view('dashboard/modulos/header');
    }

    public function mira(): string
    {
        #return view('welcome_message');
        return "ruta xxx";
    }
}
