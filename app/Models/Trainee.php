<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
