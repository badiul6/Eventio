<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;
    protected $table = 'attendees';
    public $timestamps = false;
    protected $fillable = ['id', 'first_name', 'last_name', 'phone_no', 'bio', 'address', 'user_id']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'attendee_events');
    }

}
