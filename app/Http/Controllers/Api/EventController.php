<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelationships;

class EventController extends Controller
{
    use CanLoadRelationships; //The CanLoadRelationships trait is used to load relationships
    private array $relations = ['user','attendees','attendees.user']; //The relationships to load

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->loadRelationships(Event::query()); //The loadRelationships method is used to load the relationships
        return EventResource::collection($query->latest()->paginate()); //The paginate method is used to divide the results into pages
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
        return new EventResource($this->loadRelationships($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($this->loadRelationships($event));
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

        return new EventResource($this->loadRelationships($event));
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
