<?php

namespace App\Http\Controllers\Api;

use App\Models\Base\TiempoExperiencia;
use Illuminate\Http\Request;

class TiempoExperienciaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = TiempoExperiencia::all();
        return $this->sendResponse($return, '');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Base\TiempoExperiencia  $tiempoExperiencia
     * @return \Illuminate\Http\Response
     */
    public function show(TiempoExperiencia $tiempoExperiencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Base\TiempoExperiencia  $tiempoExperiencia
     * @return \Illuminate\Http\Response
     */
    public function edit(TiempoExperiencia $tiempoExperiencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Base\TiempoExperiencia  $tiempoExperiencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiempoExperiencia $tiempoExperiencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Base\TiempoExperiencia  $tiempoExperiencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiempoExperiencia $tiempoExperiencia)
    {
        //
    }
}
