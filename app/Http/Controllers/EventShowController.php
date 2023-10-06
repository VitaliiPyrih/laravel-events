<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    public function __invoke(Event $event)
    {
        $like = $event->likes()->where('user_id',auth()->user()?->id)->first();
        $savedEvent = $event->savedEvent()->where('user_id',auth()->user()?->id)->first();
        $attendings = $event->attendings()->where('user_id',auth()->user()?->id)->first();
        $eventWithComments = Event::with(['comments' => function ($query) {
            $query->latest()->take(8);
        }])->find($event->id);
        return view('eventsShow',compact('event','like','savedEvent','attendings','eventWithComments'));
    }
}
