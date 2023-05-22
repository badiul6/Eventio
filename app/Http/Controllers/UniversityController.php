<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Society;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function uniDashboard()
    {
        return view('university/dashboard');
    }

    public function create(Request $request)
    {
        University::create($request);
        
        return redirect('/university/dashboard');
    }
    public function read(){
        $email= auth()->user()->email;
        
        $uni = University::find($email);
        
        return view('/university/dashboard')->with(['uni'=> $uni]);
    }
    public function showUpdate()
    {
        $email= auth()->user()->email;
        $uni = University::find($email);
        
        return view('/university/updateprofile')->with(['uni'=> $uni]);
    }
    
    public function loadcreateevent() 
    {
        return view('university.createevent');
    }

    public function update(Request $request){
        $email= auth()->user()->email;
        $uni = University::find($email);    // Find the Student based on Primary Key

        $uni->updateUniversity($request);
        
        return redirect('/university/dashboard');
    }
    public function delete(Request $request)
    {
        $email= auth()->user()->email;

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        User::where('email',$email)->delete();

        return redirect('/');

    }
}
