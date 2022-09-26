<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;

class CodeController extends BaseController
{
    public function generate_codes(Request $request)
    {
        Code::generate(10);
        return $this->sendResponse(true, 'Codigos');
    }

   
}
