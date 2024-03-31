<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            //An user can be the manager of many events
            $table->foreignIdFor(User::class); //Create a column named user_id and add a foreign key constraint to the id column on the users table
            $table->string('name'); //Name of the event
            $table->text('description')->nullable(); //Description of the event
            $table->dateTime('start_time'); //Start date of the event
            $table->dateTime('end_time'); //End date of the event
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
