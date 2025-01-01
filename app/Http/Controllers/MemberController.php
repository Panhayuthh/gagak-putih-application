<?php

namespace App\Http\Controllers;

use App\Models\MemberData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class MemberController extends Controller
{
    public function index()
    {
        $members = MemberData::with('user')->get();
    
        if (!Auth::check()) {
            return view('member', ['members' => $members]);
        }
    
        $role = Auth::user()->isAdmin ? 'admin' : 'user';
        $view = $role === 'admin' ? 'admin.members' : 'member';
    
        return view($view, ['members' => $members]);
    }
    
    public function create() 
    {
        if (!Auth::check()) {
            return view('registration');
        } else if (Auth::user()->isAdmin) {
            return view('admin.addMember');
        }
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|in:coach,athlete',
        'gender' => 'required|in:Male,Female',
        'school' => 'required|string|max:255',
        'medal' => 'nullable|in:gold,silver,bronze',
        'belt' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        try {
            $validated['photo'] = $request->file('photo')->store('member_photos', 'public');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
        }
    }

    try {
        MemberData::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'gender' => $validated['gender'],
            'school' => $validated['school'],
            'medal' => $validated['medal'] ?? null,
            'belt' => $validated['belt'] ?? null,
            'photo' => $validated['photo'] ?? null,
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Error creating member: ' . $e->getMessage());
    }

    return redirect()->route('members.index')->with('success', 'Member added successfully!');
}

    
public function update(Request $request, MemberData $member) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|in:coach,athlete',
        'gender' => 'required|in:Male,Female',
        'school' => 'required|string|max:255',
        'medal' => 'nullable|in:gold,silver,bronze',
        'belt' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('member_photo')) {
        try {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }

            $validated['photo'] = $request->file('member_photo')->store('member_photos', 'public');
        } catch (\Exception $e) {
            return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
        }
    } else {
        $validated['photo'] = $member->photo;
    }

    try {
        $member->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'gender' => $validated['gender'],
            'school' => $validated['school'], 
            'medal' => $validated['medal'],
            'belt' => $validated['belt'],
            'photo' => $validated['photo']
        ]);
    } catch (\Exception $e) {
        return back()->with('error', 'Error updating member: ' . $e->getMessage());
    }

    return redirect()->route('members.index')->with('success', 'Member updated successfully!');
}


    
        
    public function destroy(MemberData $member) {

        try {
            $member->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting member: ' . $e->getMessage());
        }

        return back()->with('success', 'Member deleted successfully');
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $members = $search
        ? MemberData::where('name', 'like', '%' . $search . '%')->get()
        : MemberData::all();
            return view('admin.members', compact('members', 'search'));
    }
}
