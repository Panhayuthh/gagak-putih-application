<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ClassesController extends Controller
{

    public function index()
    {
        if (Route::currentRouteName() === 'home') {
            $classes = Classes::all();
            return view('home', compact('classes'));
        } else {
            $classes = Classes::paginate(10);
            return view('admin.schedule', compact('classes'));
        }
    }
    
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'level' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
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
            Classes::create([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'level' => $validated['level'],
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'photo' => $validated['photo'] ?? null,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating class: ' . $e->getMessage());
        }

        return redirect()->route('schedule.index')->with('success', 'Class added successfully!');
    }

    public function update(Request $request, Classes $class)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'level' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            $class->update([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'level' => $validated['level'],
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating class: ' . $e->getMessage());
        }

        return redirect()->route('schedule.index')->with('success', 'Class updated successfully!');
    }

    public function destroy(Classes $class)
    {
        try {
            $class->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting class: ' . $e->getMessage());
        }

        return redirect()->route('schedule.index')->with('success', 'Class deleted successfully!');
    }
}
