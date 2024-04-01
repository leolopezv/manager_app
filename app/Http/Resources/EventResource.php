<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\AttendeeResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    //The toArray method is used to transform the resource into an JSON array.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'user'=> new UserResource($this->whenLoaded('user')), //The whenLoaded method is used to include a relationship only when it has been loaded.
            'attendees' => AttendeeResource::collection($this->whenLoaded('attendees')) //The whenLoaded method is used to include a relationship only when it has been loaded.
        ];
    }
}
