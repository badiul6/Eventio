<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;

    public $fillable = ['uni_id', 'name', 'niche', 'location', 'capacity', 'date', 'start_time', 'end_time'];
    
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    public function university() 
    {
        return $this->belongsTo(University::class);
    }

    public function topic() 
    {
        return $this->belongsTo(Topic::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
   
    
}
