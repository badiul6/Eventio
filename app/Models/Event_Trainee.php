<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Trainee extends Model
{
    use HasFactory;
    protected $table = 'event_trainees';


    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
  
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
