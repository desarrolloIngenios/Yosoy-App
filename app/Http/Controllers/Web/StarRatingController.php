<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StarRatingController extends Controller
{
    public function show(Request $request, $user_id, $offer_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.items_show'), []);
        //dd($response->json());
        $success = $response->json()['success'];
        $items = $response->json()['data'];
        $message = $response->json()['message'];
        $data['items'] = $items;

        $data['user_id'] = $user_id;
        $data['offer_id'] = $offer_id;
        //dd($data);
        return view('rating/rating_user', $data);
    }

    public function store(Request $request)
    {
        //dd($request->input());
        $response = Http::withToken(session('token'))->accept('application/json')->post(route('api.star_rating_store'), $request->input());
        //dd($response->json());

        $success = $response->json()['success'];
        $data = $response->json()['data'];
        $message = $response->json()['message'];
        //dd($profile);

        if(!$success){
            return redirect()->back()->with('status', 'Error al acceder a la cuenta!');
        }
        return redirect()->back();
    }
}
