<?php

namespace App\Http\Controllers;

use App\Events\NewCommentAdded;
use App\Models\Event;
use Illuminate\Http\Request;

class StoreCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,Event $event)
    {
        $request->validate(['content' => 'required']);
        $event->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id
        ]);
        event(new NewCommentAdded($event));
        return back();
    }
}
