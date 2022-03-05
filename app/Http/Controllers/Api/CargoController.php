<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Base\Cargo;


class CargoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargo = Cargo::orderBy('nombre')->get();
        return $this->sendResponse($cargo, 'Cargos');
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
     * @param  \App\Models\BaseCargo  $baseCargo
     * @return \Illuminate\Http\Response
     */
    public function show(BaseCargo $baseCargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BaseCargo  $baseCargo
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseCargo $baseCargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseCargo  $baseCargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaseCargo $baseCargo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseCargo  $baseCargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaseCargo $baseCargo)
    {
        //
    }
}
