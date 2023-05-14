<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function society() {
        return $this->belongsTo(Society::class, 'society_email', 'email');
    }

    public function university() {
        return $this->belongsTo(University::class, 'uni_email', 'email');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users', 'event_id', 'user_id');
    }

}
