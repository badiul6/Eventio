<?php

namespace App\Http\Controllers;

use App\Models\Event_Trainee;
use App\Models\Topic;
use App\Models\Event;
use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function read()
    {
        $attend = auth()->user()->trainee;

        if ($attend != null) {
            EventController::updateEventStatus();

            $train =  auth()->user()->trainee;
            $invites = Event_Trainee::where('trainee_id', $train->id)->where('status', 'pending')->get();

            $events = Event::whereHas('trainees', function ($query) use ($train) {
                $query->where('trainee_id', $train->id)
                    ->where('status', 'accepted');
            });

            $events2 = clone $events;

            $upcomingEvents = $events->where('status', '!=', 'completed')->get();
            $completedEvents = $events2->where('status', 'completed')->get();

            return view('/trainee/dashboard', compact('train', 'invites', 'upcomingEvents', 'completedEvents'));
        }

        return view('/trainee/dashboard');
    }

    public function create(Request $request)
    {
        $data = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'phone_no' => $request->contact,
            'bio' => $request->bio,
            'experience' => $request->experience,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ];

        $interestsArray = json_decode($request->interests);
        $topicIds = [];

        foreach ($interestsArray as $topic) {
            $existingTopic = Topic::firstOrCreate(['topic_name' => $topic]);
            $topicIds[] = $existingTopic->id;
        }

        $train = new Trainee;
        $train->create($data);

        auth()->user()->trainee->topics()->attach($topicIds);

        return $this->read();
    }

    public function update(Request $request)
    {
        $data = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'phone_no' => $request->contact,
            'address' => $request->address,
            'bio' => $request->bio,
            'experience' => $request->experience,
        ];

        auth()->user()->trainee->update($data);

        $interestsArray = json_decode($request->interests);
        $topicIds = [];

        foreach ($interestsArray as $topic) {
            $existingTopic = Topic::firstOrCreate(['topic_name' => $topic]);
            $topicIds[] = $existingTopic->id;
        }

        auth()->user()->trainee->topics()->sync($topicIds);

        return $this->read();
    }

    public function getFilteredTraninee(Request $request)
    {
        $topic = Topic::find($request->topic);

        return response()->json($topic->trainees);
    }

    public function acceptInvite(Request $req)
    {

        $r = Event_Trainee::find($req->id);
        $r->status = "accepted";
        $r->save();

        return redirect("trainee/dashboard");
    }

    public function declineInvite(Request $req)
    {

        $r = Event_Trainee::find($req->id);
        $r->status = "declined";
        $r->save();

        return redirect("trainee/dashboard");
    }
}
