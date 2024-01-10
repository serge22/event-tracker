<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia(
            'Event/Index',
            [
                'events' => Event::where('user_id', auth()->id())
                    ->take(10)
                    ->get()->load('tags')
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Event/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tags = [];

        foreach($request->input('tags') as $t) {
            $tag = Tag::firstOrCreate(['user_id' => auth()->id(), 'name' => $t]);
            $tags[] = $tag->id;
        }

//        $request->validate([
//            'tags' => 'required|integer|min:0|max:20',
//        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
