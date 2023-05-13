<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'uniname', 'uniname');
    }
}
