<?php

namespace App\Http\Controllers;

use App\Models\Topic;
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
}
