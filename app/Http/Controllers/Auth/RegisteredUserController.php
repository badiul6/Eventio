<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function loadUniRegPage(): View
    {
        return view('auth.uregister');
    }

    public function loadSocietyRegPage(): View
    {
        return view('auth.sregister');
    }



    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role="";
        if($request->role== "university"){
            $role= "university";
        }
        elseif($request->role== "society"){
            $role= "society";
        }
        else{
            $role= "user";
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);
        $r="";
        if($user->role=="university"){
            $r= "/university/dashboard";
        }
        elseif($user->role=="society"){
            $r= "/society/dashboard";
        }
        else{
            $r= "/user/createprofile";

        }

        return redirect($r);
    }
}
