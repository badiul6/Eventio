<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
     

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendee()
    {
        return $this->hasOne(Attendee::class, 'email', 'email');
    }
    public function university()
    {
        return $this->hasOne(University::class, 'email', 'email');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_users');
    }

    public function joinEvent($event_id) 
    {
        $this->events()->attach($event_id);
    }

    public function leaveEvent($event_id)
    {
        $this->events()->detach($event_id);
    }

    public function getJoinedEvents()
    {
        return $this->events();
    }
}
