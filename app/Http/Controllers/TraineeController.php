<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function read()
    {
        $train =  auth()->user()->trainee;
        
        return view('/trainee/dashboard', compact('train'));
    }

    public function create(Request $request)
    {
        // name 	address 	contact 	website 	social_link 	description
        $data = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'phone_no' => $request->contact,
            'bio' => $request->bio,
            'experience' => $request->experience,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ];

        $train = new Trainee;
        $train->create($data);

        return $this->read();
    }
    public function update(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            // Add more validation rules for other fields if needed
        ]);
        $data = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'phone_no' => $request->contact,
            'address' => $request->address,
            'bio' => $request->bio,
            'experience' => $request->experience,
            
        ];

        auth()->user()->trainee->update($data);
        
        return $this->read();
 
    }
}
