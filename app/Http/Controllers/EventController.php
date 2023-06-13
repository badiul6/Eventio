<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // id 	name 	description 	location 	capacity 	date 	start_time 	end_time 	status 	uni_id
    public function create(Request $request)
    {
       $train= $request->trainee_ids;
    
        $data = [
            'uni_id' => auth()->user()->university->id,
            'topic_id' => $request->topic,
            'name' => $request->name,
            'description' => $request->desc,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'date' => $request->datee, 
            'start_time' => $request->s_time,
            'end_time' => $request->e_time
        ];

        $event = new Event;
        $event->fill($data);
        $event->save();

        $id= $event->id;

        $events= Event::where("id",$id)->first();
        $events->trainees()->attach($train);

        return redirect('/university/dashboard');
    }

    public function read()
    {
        $part_id = auth()->user()->participant->id;
        $user_role = auth()->user()->role;
        
        $events = Event::whereDoesntHave('attendees', function ($query) use ($part_id) {
            $query->where('attendee_id', $part_id);
        })->get();

        return view('/'. $user_role . '/viewevent', compact('events'));
    }

    public function showUpdate($id)
    {
        $event = Event::where('id', $id)->first();

        return view('university.editevent')->with('event', $event);
    }

    public function goLive(Request $request){
        $event= Event::find($request->id);
        
        $event->update([
            'status'=> "active"
        ]);
        return redirect('/university/dashboard');
    }

    public function update(Request $request)
    {

        $event= Event::find($request->id);

        $event->update([
            'name' => $request->name,            
            'capacity' => $request->capacity,
            'description'=>$request->desc
        ]);   

        if (!is_null($request->t_ids))
        {
            $event= Event::find($request->id);
            $event->trainees()->syncWithoutDetaching($request->t_ids);
        }

        return redirect('/university/dashboard');
    }

    public function delete(Request $request)
    {
        Event::find($request->event)->delete();
        return redirect('/university/dashboard');
    }

    public function join(Request $request)
    {
        auth()->user()->attendee->events()->attach($request->event_id);

        return redirect('attendee/dashboard');
    }

    public function leave($event_id)
    {
        auth()->user()->participant->eventsAttendees()->detach($event_id);

        return redirect('/participant/viewjoinedevent');
    }

    public function viewJoinedEvents()
    {
        $events = auth()->user()->participant->eventsAttendees;

        return view('participant.viewjoinedevent')->with('events', $events);
    }

    public static function updateEventStatus()
    {
        $currentDateTime = now(); // Get the current date and time
        // dd($currentDateTime->toTimeString());   
        $records = Event::where('date', '<', $currentDateTime->toDateString()) // Filter by date less than the current date
            ->orWhere(function ($query) use ($currentDateTime) {
                $query->where('date', '=', $currentDateTime->toDateString()) // Filter by date equal to the current date
                    ->where('end_time', '<', $currentDateTime->toTimeString()); // Filter by end time less than the current time
            })->where('status', 'active')
            ->get();

        foreach ($records as $event) {
            $event->status = 'completed';
            $event->save();
        }
    }
}