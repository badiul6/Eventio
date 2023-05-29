<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UniversityController extends Controller
{

    public function read()
    {
        if(is_null(auth()->user()->university))
        {
            return redirect('/university/createprofile');
        }
        $uni =  auth()->user()->university;
        
        return view('/university/dashboard', compact('uni'));
    }

    public function create(Request $request)
    {

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'contact' => $request->contact,
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
            'user_id' => auth()->user()->id
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
