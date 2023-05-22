<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Models\User;

class AttendeeController extends Controller
{

    public function create(Request $request)
    {    
        $attendee = Attendee::create($request);
        
        return redirect('/user/dashboard')->with(['attendee'=>$attendee]);
    }

    public function read()
    {
        $email= auth()->user()->email;
        $attendee = Attendee::find($email);
        
        return view('/user/dashboard')->with(['attendee'=> $attendee]);
    }
    
    public function showUpdate()
    {
        $email= auth()->user()->email;
        $attendee = Attendee::find($email);
        
        return view('/user/updateprofile')->with(['attendee'=> $attendee]);
    }

    public function update(Request $request){
        $email= auth()->user()->email;
        $attendee = Attendee::find($email);    // Find the Student based on Primary Key

        $attendee->updateAttendee($request);        

        return redirect('/user/dashboard');
    }
    
    public function delete(Request $request)
    {
        $email= auth()->user()->email;

        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Attendee::find($email)->delete();    // Find the Student based on Primary Key
        User::where('email',$email)->delete();

        return redirect('/');

    }

}
