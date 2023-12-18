<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StarRatingController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('star_rating_show.index'));
        //dd($response->json());
        $success = $response->json()['success'];
        $star_rating = $response->json()['data'];
        $message = $response->json()['message'];
        $data['star_rating'] = $star_rating;

        return view('rating/star_rating_index', $data);
    }


    public function show(Request $request, $user_id, $offer_id)
    {
        $response = Http::withToken(session('token'))->accept('application/json')->get(route('api.items_show'), ['user_id' => $user_id, 'offer_id' => $offer_id]);
        //dd($response->json());
        $success = $response->json()['success'];
        $items = $response->json()['data'];
        $message = $response->json()['message'];
        $data['items'] = $items;

        $data['user_id'] = $user_id;
        $data['offer_id'] = $offer_id;

        $offer = Offer::find($offer_id);
        $user = User::find($user_id);

        $data['user'] = $user;
        $data['offer'] = $offer;



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

        if(!$success){
            return redirect()->back()->with('status', 'Error al acceder a la cuenta!');
        }
        return redirect()->back();
    }
}
