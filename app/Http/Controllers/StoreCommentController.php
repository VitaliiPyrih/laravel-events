<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class StoreCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Event $event)
    {
        $event->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id
        ]);

        return back();
    }
}
