<?php

namespace App\Listeners;

use App\Events\NewCommentAdded;
use App\Mail\NewEmileAdded;
use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFrouUserCreated
{
    public function handle(NewCommentAdded $events): void
    {
        $test = Event::find(5);
        $user = $test->load('user')->user->name;
        $user = $test->user->name;
        $user = User::with('events')->whereHas('events', fn ($e) => $e->where('id',$events->event->user_id))->first()->email;
        Mail::to($user)->send(new NewEmileAdded($events->event));
    }
}
