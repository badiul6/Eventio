<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';


    public $fillable = ['uni_id', 'topic_id', 'name', 'location', 'description', 'status', 'capacity', 'date', 'start_time', 'end_time'];
    
    public function attendees()
    {
        return $this->belongsToMany(Attendee::class, 'attendee_events');
    }

    public function university() 
    {
        return $this->belongsTo(University::class, 'uni_id');
    }

    public function topic() 
    {
        return $this->belongsTo(Topic::class);
    }

    public function trainees()
    {
        return $this->belongsToMany(Trainee::class, 'event_trainees');
    }
   
    
}