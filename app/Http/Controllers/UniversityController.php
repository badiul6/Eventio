<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Trainee;
use App\Models\Event_Trainee;
use Carbon\Carbon;



class UniversityController extends Controller
{

    public function read()
    {
        $uni =  auth()->user()->university;
        $topics = Topic::all();
        $trainees = Trainee::all();
        $eventIds = Event::where('uni_id', $uni->id)->pluck('id');

        $invites = Event_Trainee::whereIn('event_id', $eventIds)
            ->where('status', 'accepted')
            ->orWhere('status', 'declined')
            ->latest()
            ->get();
            $upcomingEvents = Event::where('uni_id', $uni->id)
            ->where('status', 'pending')
            ->latest()
            ->get();
            $events = Event::where('uni_id', $uni->id)
            ->where('status','!=' , 'pending')
            ->latest()
            ->get();
     

        $this->updateEventStatus();            

        $pevent = Event::where('uni_id', $uni->id)->where('status', 'pending')->pluck('id')->count();
        $aevent = Event::where('uni_id', $uni->id)->where('status', 'active')->pluck('id')->count();
        $cevent = Event::where('uni_id', $uni->id)->where('status', 'completed')->pluck('id')->count();

        


        return view('/university/dashboard', compact('uni', 'topics', 'trainees', 'invites', 'pevent', 'aevent', 'cevent','upcomingEvents','events'));
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
    public function getEvents(Request $request)
    {
        $event = Event::find($request->event_id);
        $train= $event->topic->trainees;
        $traineeIds = $train->pluck('id');

        $eventtrain= $event->trainees;
        $eventTraineeIds = $eventtrain->pluck('id');

        $temp = $traineeIds->diff($eventTraineeIds);

        $remainingTrainees = Trainee::where('id', $temp)->get();

        return response()->json([$event, $remainingTrainees]);
    }

    public function updateEventStatus(){
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
