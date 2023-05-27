<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;

    public $fillable = ['uni_id', 'name', 'niche', 'location', 'capacity', 'date', 'start_time', 'end_time'];

    public function university() 
    {
        return $this->belongsTo(University::class, 'uni_email', 'email');
    }

    public function trainees()
    {
        return $this->belongsToMany(Participant::class, 'events_trainees', 'event_id', 'participant_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(Participant::class, 'events_attendees', 'event_id', 'attendee_id');
    }
}
