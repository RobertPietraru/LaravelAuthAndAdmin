<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
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
            'profile' => $request->user()->profile ?? new Profile(),
        ]);
    }


    public function store(ProfileUpdateRequest $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'school' => 'required',
        ]);
        $user = auth()->user();


        if ($user->profile) {
            // update profile

            $user->profile->name = $request->input('name');
            $user->profile->phone = $request->input('phone');
            $user->profile->gender = $request->input('gender');
            $user->profile->address = $request->input('address');
            $user->profile->school = $request->input('school');
            $user->profile->save();

        } else {
            // Create a new profile
            $profile = new Profile();
            $profile->name = $request->input('name');
            $profile->phone = $request->input('phone');
            $profile->gender = $request->input('gender');
            $profile->address = $request->input('address');
            $profile->school = $request->input('school');
            // Set other profile fields from the form data

            // Associate the profile with the authenticated user
            $user->profile()->save($profile);

        }


        // Redirect the user or show a success message
        return redirect()->back()->with('success', 'Profile created successfully.');
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

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