<?php

namespace App\Http\Controllers;
use App\Models\Attendee;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\User;

class ParticipantController extends Controller
{

    public function create(Request $request)
    {    
        $data = [
            'user_id' => auth()->user()->id,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone_no' => $request->contact,
            'uni_id' => $request->uni_id,
        ];

        $part = new Participant;

        $part->fill($data);
        $part->save();
        
        return $this->read();
    }

    public function read()
    {
        $part= auth()->user()->participant;
        
        return view('/participant/dashboard', compact('part'));
    }
    
    public function showUpdate()
    {
        $part= auth()->user()->participant;
        
        return view('/participant/updateprofile', compact('part'));
    }

    public function update(Request $request){
        $part= auth()->user()->participant;

        $part->update([
            'user_id' => auth()->user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_no' => $request->phone_no,
            'uni_id' => $request->uni_id,
        ]);        

        return redirect('/participant/dashboard');
    }
    
    public function delete(Request $request)
    {
        auth()->user()->delete();

        auth()->guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
