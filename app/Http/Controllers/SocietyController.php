<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocietyController extends Controller
{
    public function societyDashboard(){
        return view('society/dashboard');
    }

}
