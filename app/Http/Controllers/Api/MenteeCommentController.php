<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenteeComment;
use Illuminate\Support\Facades\Auth;

class MenteeCommentController extends Controller
{
    /**
     * List comments for a mentee.
     */
    public function index($menteeId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $comments = MenteeComment::with('author')
            ->where('mentee_id', $menteeId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'comments' => $comments]);
    }

    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $data = $request->validate([
            'mentee_id' => 'required|integer|exists:users,id',
            'comment' => 'required|string|max:2000',
        ]);

        $comment = MenteeComment::create([
            'mentee_id' => $data['mentee_id'],
            'author_id' => Auth::id(),
            'comment' => $data['comment'],
        ]);

        return response()->json(['success' => true, 'comment' => $comment]);
    }

    /**
     * Delete a comment (author or admin).
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $comment = MenteeComment::findOrFail($id);
        $user = Auth::user();

        $hasAdminRole = false;
        if (method_exists($user, 'roles')) {
            $hasAdminRole = $user->roles()->where('name', 'ADMIN')->exists();
        }
        $canDelete = ($comment->author_id && $comment->author_id == $user->id) || $hasAdminRole;
        if (!$canDelete) {
            return response()->json(['success' => false, 'message' => 'No tiene permiso para eliminar este comentario'], 403);
        }

        $comment->delete();
        return response()->json(['success' => true]);
    }
}


// (duplicate empty class removed)
