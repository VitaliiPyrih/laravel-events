<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LikeSystemController extends Controller
{
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $like = $event->likes()->where('user_id',auth()->id())->first();
        if(!is_null($like)) {
            $like->delete();
            return null;
        } else {
            $event->likes()->create([
                'user_id' => auth()->id()
            ]);
            return $event->likes()->where('user_id', auth()->id())->first();
        }
    }
}
