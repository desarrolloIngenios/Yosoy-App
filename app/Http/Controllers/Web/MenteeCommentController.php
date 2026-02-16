<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenteeComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class MenteeCommentController extends Controller
{
    /**
     * List comments for a mentee.
     */
    public function index($menteeId)
    {
        // Forward request to API using token in session
        $token = session('token');
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'No API token in session'], 401);
        }

        $apiUrl = url('/api/mentee-comments/' . $menteeId);
        $resp = Http::withToken($token)->get($apiUrl);
        return response()->json($resp->json(), $resp->status());
    }

    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'mentee_id' => 'required|integer|exists:users,id',
            'comment' => 'required|string|max:2000',
        ]);

        $token = session('token');
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'No API token in session'], 401);
        }

        $apiUrl = url('/api/mentee-comments');
        $resp = Http::withToken($token)->post($apiUrl, $data);
        return response()->json($resp->json(), $resp->status());
    }

    /**
     * Delete a comment (author or admin).
     */
    public function destroy($id)
    {
        $token = session('token');
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'No API token in session'], 401);
        }

        $apiUrl = url('/api/mentee-comments/' . $id);
        $resp = Http::withToken($token)->delete($apiUrl);
        return response()->json($resp->json(), $resp->status());
    }
}
