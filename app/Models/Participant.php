<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Participant extends Model
{
    use HasFactory;
    
    public $fillable = ['user_id', 'uni_id', 'first_name', 'last_name', 'phone_no'];

    // Relation - Start
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function university()
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function eventsTrainees()
    {
        return $this->belongsToMany(Event::class, 'events_trainees', 'participant_id', 'event_id');
    }

    public function eventsAttendees()
    {
        return $this->belongsToMany(Event::class, 'events_attendees', 'attendee_id', 'event_id');
    }
}
