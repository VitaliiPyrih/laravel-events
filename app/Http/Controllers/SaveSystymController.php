<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class SaveSystymController extends Controller
{
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $saveEvent = $event->savedEvent()->where('user_id',auth()->id())->first();
        if(!is_null($saveEvent)) {
            $saveEvent->delete();
            return null;
        } else {
            $event->savedEvent()->create([
                'user_id' => auth()->id()
            ]);
            return $event->savedEvent()->where('user_id', auth()->id())->first();
        }
    }
}
