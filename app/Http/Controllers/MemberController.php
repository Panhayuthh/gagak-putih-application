<?php

namespace App\Http\Controllers;

use App\Models\MemberData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class MemberController extends Controller
{
    // public function index()
    // {
    //     $members = MemberData::paginate(10);
    
    //     if (!Auth::check()) {
    //         return view('member', ['members' => $members]);
    //     }
    
    //     $role = Auth::user()->isAdmin ? 'admin' : 'user';
    //     $view = $role === 'admin' ? 'admin.members' : 'member';
    
    //     return view($view, ['members' => $members]);
    // }

    public function index(Request $request)
    {
        $members = MemberData::paginate(10);

        if (!Auth::check()) {
            return view('member', ['members' => $members]);
        }

        $search = $request->input('search');

        $membershipRequests = MemberData::where('isApproved', '0')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10, ['*'], 'membership_requests');

        $currentMembers = MemberData::where('isApproved', '1')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10, ['*'], 'current_members');

        return view('admin.members', compact('membershipRequests', 'currentMembers', 'search'));
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

    
    public function update(Request $request, MemberData $member)
    {
        // dd($member, $request->all());

        $validated = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'school' => 'required',
            'medal' => 'nullable',
            'belt' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->hasFile('photo')) {

                if ($member->photo) {
                    Storage::disk('public')->delete($member->photo);
                }

                $validated['photo'] = $request->file('photo')->store('member_photos', 'public');
            }

            $member->update([
                'name' => $validated['name'],
                'role' => $validated['role'],
                'gender' => $validated['gender'],
                'school' => $validated['school'],
                'medal' => $validated['medal'] ?? null,
                'belt' => $validated['belt'] ?? null,
                'photo' => $validated['photo'] ?? $member->photo,
            ]);

            return redirect()->route('members.index')->with('success', 'Member updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating member: ' . $e->getMessage());
        }
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

    public function approve(MemberData $member)
    {
        $member->isApproved = true;
        $member->save();
        return redirect()->route('members.index')->with('success', 'Member approved!');
    }
}
