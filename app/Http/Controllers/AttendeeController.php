<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendee;
use Illuminate\Http\Request;
use App\Models\User;

class AttendeeController extends Controller
{
    public function create(Request $request){
        
        // $user= Auth::users();
        $attendee= new Attendee;

        $attendee->email= auth()->user()->email;
        
        $attendee->firstname= $request->firstname;
        $attendee->lastname= $request->lastname;
        $attendee->contact= $request->contact;
        $attendee->uniname= $request->uniname;

        $attendee->save();
        return redirect('/user/dashboard',)->with(['attendee'=>$attendee]);
    }

    public function read(){
        $email= auth()->user()->email;
        
        $attendee = Attendee::find($email);
        
        return view('/user/dashboard')->with(['attendee'=> $attendee]);
    }
    public function loadupdate(){
        $email= auth()->user()->email;
        $attendee = Attendee::find($email);
        

        return view('/user/updateprofile')->with(['attendee'=> $attendee]);
    }
    public function update(Request $request){
        $email= auth()->user()->email;
        $attendee = Attendee::find($email);    // Find the Student based on Primary Key

        $attendee->firstname= $request->firstname;
        $attendee->lastname= $request->lastname;
        $attendee->contact= $request->contact;
        $attendee->uniname= $request->uniname;
        
        $attendee->save();        
        return redirect('/user/dashboard');
    }
    public function delete(Request $request)
    {
        $email= auth()->user()->email;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Attendee::find($email)->delete();    // Find the Student based on Primary Key

        User::where('email',$email)->delete();

        return redirect('/');

    }

}
