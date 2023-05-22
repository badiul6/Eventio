<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Attendee extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    public $fillable = ['email', 'firstname', 'lastname', 'contact', 'uniname'];

    // Relation - Start
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    
    public function university()
    {
        return $this->belongsTo(University::class, 'uniname', 'uniname');
    }

    // Relation - End

    public static function create(Request $request) : Attendee
    {
        $attendee = new Attendee;
        
        $data = [
            'email' => auth()->user()->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'contact' => $request->contact,
            'uniname' => $request->uniname,
        ];

        $attendee->fill($data);
        $attendee->save();

        return $attendee;
    }

    public function updateAttendee(Request $request)
    {
        self::update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'contact' => $request->contact,
            'uniname' => $request->uniname,
        ]);
    }
}
