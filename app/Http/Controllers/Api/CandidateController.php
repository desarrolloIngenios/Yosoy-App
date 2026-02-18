<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends BaseController
{

    public function index()
    {
        $candidatas = User::with('profile')->where('id_lideresa', auth()->user()->id)->get();

        return $this->sendResponse($candidatas, 'candidatas');
    }

    public function index_lideresas()
    {
        $candidatas = User::with('profile')
            ->whereHas('profile', function ($query) {
                $query->whereNotNull('name')
                    ->where('name', '!=', '')
                    ->whereNotNull('numero_contacto_1')
                    ->where('numero_contacto_1', '!=', '')
                    ->whereNotNull('email')
                    ->where('email', '!=', '');
            })
            ->whereDoesntHave('roles')
            ->orderByDesc('created_at')
            ->get();
        // dd($candidatas);
        return $this->sendResponse($candidatas, 'candidatas');
    }
}
