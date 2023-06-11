<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    // id 	name 	description 	location 	capacity 	date 	start_time 	end_time 	status 	uni_id
    public function create(Request $request)
    {
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
        $checkedTraineeIds = $request->input('trainee_ids', []);
        
        
        
        $event = new Event;
        $event->fill($data);
        $event->save();

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

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        $event->update([
            'uni_id' => auth()->user()->university->id,
            'name' => $request->name,
            'niche' => $request->niche,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'date' => $request->date, 
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);   

        return redirect('/university/viewevent');
    }

    public function delete($id)
    {
        Event::find($id)->delete();
        return redirect('/university/viewevent');
    }

    public function join($event_id)
    {
        auth()->user()->participant->eventsAttendees()->attach($event_id);

        return redirect('/participant/viewevent');
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
}