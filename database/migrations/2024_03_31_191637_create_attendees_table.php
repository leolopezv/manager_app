<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Event;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();

            //An user can attend many events
            $table->foreignIdFor(User::class); //Create a column named user_id and add a foreign key constraint to the id column on the users table
            //An event can have many attendees
            $table->foreignIdFor(Event::class); //Create a column named event_id and add a foreign key constraint to the id column on the events table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};
