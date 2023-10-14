<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Models\Country;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::with('country')->get();
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.create',compact('countries','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventsRequest $request): RedirectResponse
    {

        if($request->hasFile('image')) {
            $data = $request->validated();
            try {
                DB::beginTransaction();
                $data['image'] = Storage::putFile('events',$request->file('image'));
                $data['user_id'] = auth()->id();
                $data['slug'] = Str::slug($data['title']);


                $event = Event::query()->create($data);
                $event->tags()->attach($data['tags'],['created_at' => now(),'updated_at' => now()]);
                DB::commit();
            } catch (\Exception $error) {
                DB::rollBack();
                return redirect()->back()->withErrors(['city_error' => __('Виберіть місто'),'country_error' => __('Виберіть Країну')]);
            }
        }
        return to_route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $countries = Country::all();
        $tags = Tag::all();

        return view('events.edit',compact('countries','tags','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events',$data['image']);
        }

        $data['slug'] = Str::slug($data['title']);
        $event->update($data);
        $event->tags()->sync($data['tags']);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();
        return to_route('events.index');


    }
}
