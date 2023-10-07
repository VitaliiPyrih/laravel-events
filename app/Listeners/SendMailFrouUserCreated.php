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
        $user = User::with('events')->whereHas('events', fn ($e) => $e)->first()->email;
        Mail::to($user)->send(new NewEmileAdded($events->event));
    }
}
