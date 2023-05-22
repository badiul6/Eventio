<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function create(Request $request)
    {
        Event::create($request);

        return redirect('/university/dashboard');
    }

    public function read()
    {
        $user_role = auth()->user()->role;

        if ($user_role === 'university') {

            $email = auth()->user()->email;
            $events = $this->event->getEventsForUniversity($email);

        } else {
            $user_id = auth()->user()->id;
            $events = $this->event->getEventsForUser($user_id);
        }

        return view('/'. $user_role . '/viewevent')->with(['events'=> $events]);
    }

    public function showUpdate($id)
    {
        $event = Event::where('id', $id)->first();

        return view('university.editevent')->with('event', $event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);  // Find the Student based on Primary Key

        $event->updateEvent($request);   

        return redirect('/university/viewevent');
    }

    public function delete($id)
    {
        Event::find($id)->delete();
        return redirect('/university/viewevent');
    }

    public function join($id)
    {
        auth()->user()->joinEvent($id);

        return redirect('/user/viewevent');
    }

    public function leave($id)
    {
        auth()->user()->leaveEvent($id);

        return redirect('/user/viewjoinedevent');
    }

    public function viewJoinedEvents()
    {
        $user = auth()->user();
        $events = $user->getJoinedEvents()->get();

        return view('user.viewjoinedevent')->with('events', $events);
    }
}
