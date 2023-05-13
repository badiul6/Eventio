<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function uniDashboard(){
        return view('university/dashboard');
    }
}
