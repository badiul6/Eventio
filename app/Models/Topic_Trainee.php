<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic_Trainee extends Model
{
    use HasFactory;
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
