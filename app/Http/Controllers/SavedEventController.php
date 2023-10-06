<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SavedEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('savedEvent')->whereHas('savedEvent',function ($q) {
            $q->where('user_id',auth()->user()->id);
        })->get();
        return view('events.savedEvents',compact('events'));
    }
}
