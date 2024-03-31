<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); //An attendee belongs to a user
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class); //An attendee belongs to an event
    }
}
