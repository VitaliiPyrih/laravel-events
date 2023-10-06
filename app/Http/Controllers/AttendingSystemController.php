<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AttendingSystemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $attending = $event->attendings()->where('user_id',auth()->id())->first();
        if(!is_null($attending)) {
            $attending->delete();
            return null;
        } else {
            $event->attendings()->create([
                'user_id' => auth()->id(),
                'num_ticker' => 1
            ]);
            return $event->attendings()->where('user_id', auth()->id())->first();
        }
    }
}
