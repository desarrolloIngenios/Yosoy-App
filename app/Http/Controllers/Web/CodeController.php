<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Code;


class CodeController extends Controller
{
    public function generate_code(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.generate_codes'));
        //dd($response->json());
        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];

        return redirect()->back();
    }

    public function show_code(Request $request)
    {
        $codes = Code::all();
        $data = [
            'codes' => $codes,
        ];
        return view('codes/index', $data);
        
    }

}
