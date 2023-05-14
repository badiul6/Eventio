<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    
    public function university()
    {
        return $this->belongsTo(University::class, 'uniname', 'uniname');
    }

    public function events() {
        return $this->hasMany(Event::class, 'society_email', 'email');
    }
    
}
