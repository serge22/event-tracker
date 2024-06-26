<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('tags')
            ->orderByDesc('created_at')
            ->paginate(20);

        return inertia('Event/Index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::select('name')->withCount(['events'])->orderByDesc("events_count")->paginate(5)->pluck('name');
        return inertia('Event/Create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tags' => 'required',
            'date' => 'required',
        ]);

        $tags = [];
        foreach($request->input('tags') as $t) {
            $tag = Tag::firstOrCreate(['user_id' => auth()->id(), 'name' => $t]);
            $tags[] = $tag->id;
        }

        $event = Event::create([
            'user_id' => auth()->id(),
            'created_at' => $request->date('date'),
        ]);

        $event->tags()->attach($tags);

        return to_route('event.index');
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
    public function edit(string $id)
    {
        $event = Event::findOrFail($id)->load('tags');
        $tags = Tag::select('name')->withCount(['events'])->orderByDesc("events_count")->paginate(5)->pluck('name');

        return inertia('Event/Edit', ['event' => $event, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tags' => 'required',
            'date' => 'required',
        ]);

        $tags = [];
        foreach($request->input('tags') as $t) {
            $tag = Tag::firstOrCreate(['user_id' => auth()->id(), 'name' => $t]);
            $tags[] = $tag->id;
        }

        $event = Event::findOrFail($id);
        $event->created_at = $request->date('date');
        $event->save();

        $event->tags()->sync($tags);

        return redirect()->route('event.index')->with('message', 'Event was changed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return to_route('event.index')->with('message', 'Deleted');
    }

    /**
     * Restore soft-deleted model
     * @param string $id
     */
    public function restore(string $id) {
        $event = Event::withTrashed()->findOrFail($id);

        if ($event->trashed()) {
            $event->restore();
        }

        return to_route('event.index');
    }
}
