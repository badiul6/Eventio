<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';


    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
    public function university()
    {
        return $this->belongsTo(University::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
