<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Event;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function getCountry(Country $country): JsonResponse
    {
        return response()->json($country->cities);
    }

    public function indexCountry(): View
    {
        $events = Event::with('country', 'tags')->orderBy('created_at', 'desc')->paginate(12);
        return view('eventIndex',compact('events'));
    }

    public function showController(Event $event): View
    {
        $like = $event->likes()->where('user_id',auth()->id())->first();
        $savedEvent = $event->savedEvent()->where('user_id',auth()->id())->first();
        $attendings = $event->attendings()->where('user_id',auth()->id())->first();
        $eventWithComments = Event::with(['comments' => function ($query) {
            $query->latest()->take(8);
        }])->find($event['id']);

        return view('eventsShow',compact('event','like','savedEvent','attendings','eventWithComments'));
    }
}
