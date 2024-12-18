<?php

namespace App\Http\Controllers;

use App\Models\MemberData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = MemberData::with('user')->get();
        return view('member' , compact('members'));
        // return $members;
    }

    public function create() 
    {
        return view('registration');
    }

    public function store(Request $request) {
        dd($request->all());

        // Validate the request
        $validated = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'school' => 'required',
            'belt' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if photo is uploaded
        $profileImagePath = $request->hasFile('image')
        ? $request->file('member_profile')->store('member_profiles', 'public')
        : null;
        

        // store the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
        ]);

        // store the user data
        MemberData::created([
            'user_id' => $user->id,
            'role' => $validated['role'],
            'gender' => $validated['gender'],
            'school' => $validated['school'],
            'belt' => $validated['belt'],
            'photo' => $profileImagePath,
        ]);

        // redirect back
        return redirect()->back()->with('success', 'Member created successfully');
    }
}
