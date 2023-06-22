<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Picture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function upload_dp(Request $req)//
    {
        $req->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlx,csv,jpg,png|max:100000',
        ]);

        $filename = time() . '.' . $req->file->extension();
        $req->file->move('uploads', $filename);

        if (auth()->user()->picture != null) {
            $pic = Picture::where('user_id', auth()->user()->id)->first();
            $pic->dp_path = $filename;
            $pic->save();

            return redirect(auth()->user()->role . '/dashboard');
        } else {
            $filewritter = new Picture;
            $filewritter->dp_path = $filename;
            $filewritter->user_id = auth()->user()->id;
            $filewritter->save();

            return redirect(auth()->user()->role . '/dashboard');
        }
    }

    public function upload_cover(Request $req)//
    {
        $req->validate([
            'file' => 'required|mimes:pdf,doc,docx,xlx,csv,jpg,png|max:4048',
        ]);
        $filename = time() . '.' . $req->file->extension();
        $req->file->move('uploads', $filename);

        if (auth()->user()->picture != null) {
            $pic = Picture::where('user_id', auth()->user()->id)->first();
            $pic->cover_path = $filename;
            $pic->save();

            return redirect(auth()->user()->role . '/dashboard');
        } else {
            $filewritter = new Picture;
            $filewritter->cover_path = $filename;
            $filewritter->user_id = auth()->user()->id;
            $filewritter->save();

            return redirect(auth()->user()->role . '/dashboard');
        }
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
