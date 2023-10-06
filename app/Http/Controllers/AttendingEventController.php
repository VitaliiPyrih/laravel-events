<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class AttendingEventController extends Controller
{
    public function __invoke(): View
    {
        $events = Event::with('attendings')->whereHas('attendings',function ($q) {
            $q->where('user_id',auth()->user()->id);
        })->get();
        return view('events.attendingEvents',compact('events'));
    }
}
