<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Event extends Model
{
    use HasFactory;
    public $fillable = ['society_email', 'uni_email', 'name', 'niche', 'location', 'capacity'];
    // Relations - Start

    public function society() {
        return $this->belongsTo(Society::class, 'society_email', 'email');
    }

    public function university() {
        return $this->belongsTo(University::class, 'uni_email', 'email');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users');
    }

    public static function create(Request $request) : Event
    {
        $data = [
            'uni_email' => auth()->user()->email,
            'society_email' => $request->has('society_email') ? $request->society_email : null,
            'name' => $request->name,
            'niche' => $request->niche,
            'location' => $request->location,
            'capacity' => $request->capacity,
        ];

        $event = new Event;
        $event->fill($data);
        $event->save();

        return $event;
    }

    public function updateEvent(Request $request)
    {
        self::update([
            'uni_email' => auth()->user()->email,
            'society_email' => $request->has('society_email') ? $request->society_email : null,
            'name' => $request->name,
            'niche' => $request->niche,
            'location' => $request->location,
            'capacity' => $request->capacity,
        ]);
    }
    
    // Relations - End
    public function getEventsForUser($user_id)
    {
        return self::whereNotIn('id', 
            function($query) use ($user_id) {
                $query->select('event_id')->from('event_users')->where('user_id', $user_id);
            }
        )->get();
    }

    public function getEventsForUniversity($uni_email) 
    {
        return self::where('uni_email', $uni_email)->get();
    }
}
