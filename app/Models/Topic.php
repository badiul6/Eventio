<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function trainees() {
        return $this->hasMany(Trainee::class);
    }
}
