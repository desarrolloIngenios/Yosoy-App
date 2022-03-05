<?php

namespace App\Http\Controllers\Api;

use App\Models\Base\NivelEducativo;
use Illuminate\Http\Request;

class NivelEducativoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nivel_educativo = NivelEducativo::all();
        return $this->sendResponse($nivel_educativo, 'nivel_educativo');
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
     * @param  \App\Models\Base\NivelExperiencia  $nivelExperiencia
     * @return \Illuminate\Http\Response
     */
    public function show(NivelExperiencia $nivelExperiencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Base\NivelExperiencia  $nivelExperiencia
     * @return \Illuminate\Http\Response
     */
    public function edit(NivelExperiencia $nivelExperiencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Base\NivelExperiencia  $nivelExperiencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NivelExperiencia $nivelExperiencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Base\NivelExperiencia  $nivelExperiencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(NivelExperiencia $nivelExperiencia)
    {
        //
    }
}
