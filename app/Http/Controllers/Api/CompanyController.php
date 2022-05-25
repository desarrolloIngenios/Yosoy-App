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
}
