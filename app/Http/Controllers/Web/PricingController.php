<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        return view('pricing/index', $data);
    }

}
