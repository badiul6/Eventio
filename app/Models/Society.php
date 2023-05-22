<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Society extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    public $fillable = ['email', 'name', 'type', 'uniname'];

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

    public static function create(Request $request) : Society
    {
        $data = [
            'email' => auth()->user()->email,
            'name' => $request->name,
            'uniname' => $request->uniname,
            'type' => $request->type
        ];

        $society = new Society;
        $society->fill($data);
        $society->save();

        return $society;
    }

    public function updateSociety(Request $request)
    {
        self::update([
            'name' => $request->name,
            'uniname' => $request->uniname,
            'type' => $request->type,
            'uniname' => $request->uniname,
        ]);    
    }

}
