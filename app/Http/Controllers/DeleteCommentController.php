<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeleteCommentController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws AuthorizationException
     */
    public function __invoke($id,Comment $comment)
    {
        if(Gate::denies('delete',$comment)) {
            return back();
        }
        $this->authorize('delete',$comment);
        $comment->delete();
        return back();
    }
}
