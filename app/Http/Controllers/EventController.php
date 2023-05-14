<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function read()
    {
        if (auth()->user()->role === 'user') {
            
            $user_id = auth()->user()->id;
            $events = Event::whereNotIn('id', function($query) use ($user_id) {
                $query->select('event_id')->from('event_users')->where('user_id', $user_id);
            })->get();
        
            return view('/user/viewevent')->with(['events'=> $events]);
        } else {

            $email = auth()->user()->email;

            $events = Event::where('uni_email', $email)->get();

            return view('/university/viewevent')->with(['events' => $events]);
        }
    }

    public function create(Request $request)
    {
        // $user= Auth::users();
        $event = new Event;

        $event->uni_email = auth()->user()->email;
        $event->society_email = $request->has('society_email') ? $request->society_email : null;
        $event->name = $request->name;
        $event->niche = $request->niche;
        $event->location = $request->location;
        $event->capacity = $request->capacity;

        $event->save();

        return redirect('/university/dashboard');
    }

    public function showUpdate($id)
    {

        $event = Event::where('id', $id)->first();

        return view('university.editevent')->with('event', $event);
    }

    public function join($id)
    {
        $event = Event::where('id', $id)->first();
        $userId = auth()->user()->id;

        $eventUser = new EventUser;

        $eventUser->user_id = $userId;
        $eventUser->event_id = $event->id;

        $eventUser->save();

        return redirect('/user/viewevent');
    }

    public function leave($id)
    {
        $user = auth()->user()->id;

        $event = EventUser::where('event_id', $id)
            ->where('user_id', $user)
            ->first();

        $event->delete();

        return redirect('/user/viewjoinedevent');
    }

    public function viewJoined()
    {
        $userId = auth()->user()->id;
        
        $events = EventUser::where('user_id', $userId)
        ->join('events', 'event_users.event_id', '=', 'events.id')
        ->select('events.*')
        ->get();

        return view('user.viewjoinedevent')->with('events', $events);
    }

    public function update(Request $request, $id)
    {

        $event = Event::find($id);

        $event->uni_email = $request->uni_email;
        $event->society_email = $request->has('society_email') ? $request->society_email : null;
        $event->name = $request->name;
        $event->niche = $request->niche;
        $event->location = $request->location;
        $event->capacity = $request->capacity;

        $event->save();

        return redirect('/university/viewevent');
    }

    public function delete($id)
    {
        $event = Event::find($id);

        $event->delete();

        return redirect('/university/viewevent');
    }
}
