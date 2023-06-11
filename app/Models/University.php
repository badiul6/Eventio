<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $table = 'universities';

    // name 	address 	contact 	website 	social_link 	description
    public $fillable = ['name', 'contact', 'address', 'website', 'description', 'social_link', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function events() {
        return $this->hasMany(Event::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
   
}