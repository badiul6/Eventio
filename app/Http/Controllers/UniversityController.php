<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Trainee;
use App\Models\Event_Trainee;
use App\Models\Picture;
use Carbon\Carbon;

use function PHPUnit\Framework\isNull;

class UniversityController extends Controller
{

    public function read()
    {
        $uni =  auth()->user()->university;
        $topics = Topic::all();
        $trainees = Trainee::all();
        if ($uni != null) {
            EventController::updateEventStatus();
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
                ->where('status', '!=', 'pending')
                ->latest()
                ->get();

            $pic = Picture::where('user_id', auth()->user()->id)->first();

            $pevent = Event::where('uni_id', $uni->id)->where('status', 'pending')->pluck('id')->count();
            $aevent = Event::where('uni_id', $uni->id)->where('status', 'active')->pluck('id')->count();
            $cevent = Event::where('uni_id', $uni->id)->where('status', 'completed')->pluck('id')->count();
            
            return view('/university/dashboard', compact('uni', 'pic', 'topics', 'trainees', 'invites', 'pevent', 'aevent', 'cevent', 'upcomingEvents', 'events'));
        }
        return view('/university/dashboard', compact('uni'));
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
        $train = $event->topic->trainees;
        $traineeIds = $train->pluck('id');

        $eventtrain = $event->trainees;
        $eventTraineeIds = $eventtrain->pluck('id');

        $temp = $traineeIds->diff($eventTraineeIds);

        if (is_null($temp) || count($temp) === 0) {
            return response()->json([$event, []]);
        }

        $remainingTrainees = array();

        foreach ($temp as $t) {
            $train = Trainee::where('id', $t)->first();
            $remainingTrainees[] = $train;
        }

        return response()->json([$event, $remainingTrainees]);
    }
}
