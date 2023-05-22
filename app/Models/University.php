<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class University extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    public $fillable = ['email', 'uniname', 'contact', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    
    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'uniname', 'uniname');
    }
    
    public function society()
    {
        return $this->hasMany(Society::class, 'uniname', 'uniname');
    }

    public function events() {
        return $this->hasMany(Event::class, 'uni_email', 'email');
    }

    public static function create(Request $request) : University
    {
        $data = [
            'email' => auth()->user()->email,
            'uniname' => $request->uniname,
            'contact' => $request->contact,
            'address' => $request->address
        ];
        
        $uni = new University;
        
        $uni->fill($data);
        $uni->save();

        return $uni;
    } 

    public function updateUniversity(Request $request)
    {
        self::update([
            'uniname' => $request->uniname,
            'contact' => $request->contact,
            'address' => $request->address,
        ]);
    }
}
