<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;

class CompanyController extends BaseController
{
    public function store(Request $request)
    {
        $user = $request->user();
        //$profile = Profile::find(1);
        $empresa = new Empresa();
        $empresa->fill($request->except(['_token']));
        $empresa->user_id = $user->id;
        $empresa->save();
        return $this->sendResponse($empresa, 'Empresa');
    }

    public function index()
    {
        $empresa = Empresa::with(
           'ciudad'
            )->get();
        return $this->sendResponse($empresa, 'empresa');
    }

    public function update(Request $request)
    {
        $input = $request->all();
        //$user = $request->user();
        $empresa = Empresa::find($input['id']);
        $empresa->fill($request->except(['_token']));
        //$empresa->user_id = $user->id;
        $empresa->save();
        
        return $this->sendResponse($empresa, 'Empresa');
    }

    public function find(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        
        return $this->sendResponse($empresa, 'Empresa');
    }

}
