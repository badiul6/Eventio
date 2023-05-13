<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocietyController extends Controller
{
    public function societyDashboard(){
        return view('society/dashboard');
    }

    public function create(Request $request){
        
        // $user= Auth::users();
        $society= new Society;

        $society->email= auth()->user()->email;
        
        $society->name= $request->name;
        $society->uniname= $request->uniname;
        $society->type= $request->type;

        $society->save();
        return redirect('/society/dashboard',);
    }
    public function read(){
        $email= auth()->user()->email;
        
        $society = Society::find($email);
        
        return view('/society/dashboard')->with(['society'=> $society]);
    }
    public function loadupdate(){
        $email= auth()->user()->email;
        $society = Society::find($email);
        

        return view('/society/updateprofile')->with(['society'=> $society]);
    }

    public function update(Request $request){
        $email= auth()->user()->email;
        $society = Society::find($email);    // Find the Student based on Primary Key

        $society->name= $request->name;
        $society->uniname= $request->uniname;
        $society->type= $request->type;
        
        $society->save();        
        return redirect('/society/dashboard');
    }
    public function delete(Request $request)
    {
        $email= auth()->user()->email;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Society::find($email)->delete();    // Find the Student based on Primary Key

        User::where('email',$email)->delete();

        return redirect('/');

    }
}
