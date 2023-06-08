<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee_Event extends Model
{
    use HasFactory;
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
}
