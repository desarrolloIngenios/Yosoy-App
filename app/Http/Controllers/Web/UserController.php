<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.user_list'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $users = $response->json()['data'];
        $message = $response->json()['message'];
        $data['users'] = $users;
        
        return view('users/list', $data);
    }


}
