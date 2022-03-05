<?php

namespace App\Http\Controllers\Api;

use App\Models\Base\TipoContrato;
use Illuminate\Http\Request;

class TipoContratoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = TipoContrato::all();
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
     * @param  \App\Models\Base\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function show(TipoContrato $tipoContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Base\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoContrato $tipoContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Base\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoContrato $tipoContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Base\TipoContrato  $tipoContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoContrato $tipoContrato)
    {
        //
    }
}
