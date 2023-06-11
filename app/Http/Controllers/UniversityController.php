<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Trainee;

class UniversityController extends Controller
{

    public function read()
    {
        $uni =  auth()->user()->university;
        $topics = Topic::all();
        $trainees= Trainee::all();



        
        return view('/university/dashboard', compact('uni','topics','trainees'));
    }

    public function create(Request $request)
    {
        // name 	address 	contact 	website 	social_link 	description
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'website' => $request->website,
            'social_link' => $request->social,
            'description' => $request->desc,
            'user_id' => auth()->user()->id
        ];

        $uni = new University;
        $uni->create($data);

        return $this->read();
    }
    
    public function showUpdate()
    {
        $uni =  auth()->user()->university;
        
        return view('/university/updateprofile', compact('uni'));
    }
    
    public function loadcreateevent() 
    {
        return view('university.createevent');
    }

    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
            'website' => $request->website,
            'social_link' => $request->social,
            'description' => $request->desc,
            
        ];

        auth()->user()->university->update($data);
        
        return redirect('/university/dashboard');
    }

    public function delete(Request $request)
    {
        auth()->user()->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}