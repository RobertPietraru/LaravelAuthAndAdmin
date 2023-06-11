<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\DeleteUserRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function showcreate(Request $request)
    {

        return view('admin.users.create');
    }

    public function create(CreateUserRequest $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'school' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Create a new profile
        $profile = new Profile();
        $profile->name = $request->input('name');
        $profile->phone = $request->input('phone');
        $profile->gender = $request->input('gender');
        $profile->address = $request->input('address');
        $profile->school = $request->input('school');
        // Set other profile fields from the form data

        $user->profile()->save($profile);
        return Redirect::to('/admin');
        // return view('admin.users', ['users' => $users, 'admin' => $request->user()]);
    }

    public function update(Request $request, User $user)
    {
        return view('admin.users.update', ['user' => $user, 'profile' => $user->profile ?? new Profile()]);
    }

    public function edit(EditUserRequest $request, User $user)
    {
        error_log('editing');

        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'school' => 'required',
        ]);

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

        $user->email = $request->input('email');
        $user->save();



        // Redirect the user or show a success message

        return Redirect::to('/admin');

    }

    public function delete(DeleteUserRequest $request, User $user)
    {

        if (!($request->user() == $user)) {
            $profile = $user->profile;

            if ($profile) {
                $profile->delete();
            }

            $user->delete();
        }

        return redirect()->back()->with('success', 'User deleted successfully');

    }
    public function get(Request $request)
    {

        $users = User::all();
        return view('admin.users', ['users' => $users, 'admin' => $request->user()]);

    }
    //
}