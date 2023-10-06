<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('country','tags')->where('start_date','>=',today())->orderBy('created_at','desc')->paginate(6);
        return view('welcome',compact('events'));
    }
}
