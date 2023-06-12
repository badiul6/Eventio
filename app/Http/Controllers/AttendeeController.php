<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index()
    {
        return view("attendee.dashboard");
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

        return view('attendee.dashboard');
    }
}
