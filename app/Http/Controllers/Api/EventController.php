<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventResource::collection(Event::with('user')->get()); //The with method is used to eager load the user relationship
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',//The name field is required, must be a string and have a maximum length of 255 characters
                'description' => 'nullable|string',//The description field is optional and must be a string
                'start_time' => 'required|date',//The start_date field is required and must be a date
                'end_time' => 'required|date|after:start_time',//The end_date field is required, must be a date and must be after the start_date
            ]),
            'user_id' => 1,
        ]);
        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user','attendees'); //The load method is used to lazy load the user relationship
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update(
            $request->validate([
                'name' => 'sometimes|string|max:255', //Sometimes means the field is optional
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time',
            ])
        );

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
