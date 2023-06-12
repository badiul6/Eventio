<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Attendee_Event;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index()
    {
        $joinedEvents= Attendee_Event::where('attendee_id', auth()->user()->attendee->id)->pluck('event_id');
        
        
        $events= Event::where('status', 'active')
        ->get();
      
        return view("attendee/dashboard", compact('events'));
    }

    public function create(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_no' => $request->phone_no,
            'bio' => $request->bio,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ];

        $model = new Attendee;
        $model->fill($data);
        $model->save();

        return redirect('attendee/dashboard');
    }
    public function update(Request $request)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'bio' => $request->bio,
            

        ];

        auth()->user()->attendee->update($data);

        return redirect('attendee/dashboard');
    }

}
