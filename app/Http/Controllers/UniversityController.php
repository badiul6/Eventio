<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendee;
use App\Models\Society;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function uniDashboard(){
        return view('university/dashboard');
    }

    public function create(Request $request){
        
        // $user= Auth::users();
        $uni= new University;

        $uni->email= auth()->user()->email;
        
        $uni->uniname= $request->uniname;
        $uni->contact= $request->contact;
        $uni->address= $request->address;

        $uni->save();
        return redirect('/university/dashboard',);
    }
    public function read(){
        $email= auth()->user()->email;
        
        $uni = University::find($email);
        
        return view('/university/dashboard')->with(['uni'=> $uni]);
    }
    public function loadupdate(){
        $email= auth()->user()->email;
        $uni = University::find($email);
        

        return view('/university/updateprofile')->with(['uni'=> $uni]);
    }
    
    public function update(Request $request){
        $email= auth()->user()->email;
        $uni = University::find($email);    // Find the Student based on Primary Key

        $uni->uniname= $request->uniname;
        $uni->contact= $request->contact;
        $uni->address= $request->address;
        
        $uni->save();        
        return redirect('/university/dashboard');
    }
    public function delete(Request $request)
    {
        $email= auth()->user()->email;
        $university = University::find($email);
        $name=$university->uniname;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $societies = Society::where('uniname', $name)->get();
        foreach ($societies as $society) {
            $society->delete();
        }
        University::find($email)->delete();    // Find the Student based on Primary Key

        User::where('email',$email)->delete();

        

        return redirect('/');

    }
}
