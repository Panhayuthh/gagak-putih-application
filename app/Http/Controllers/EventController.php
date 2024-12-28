<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index() {
        $events = Event::paginate(6); 
    
        if (!Auth::check()) {
            return view('events', [ 
                'events' => $events,
            ]);
        }
    
        $role = Auth::user()->isAdmin ? 'admin' : 'user'; 
        $view = $role === 'admin' ? 'admin.events' : 'events'; 
        return view($view, [ 
            'events' => $events,
        ]);
    }
    public function create()
    {
        return view('admin.addEvent');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required', 
            'event_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'date' => 'required|date',
        ]);
    
        if ($request->hasFile('event_photo')) {
            try {
                $validated['photo'] = $request->file('event_photo')->store('event_photos', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
            }
        }
    
        try {
            $event = Event::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'photo' => $validated['photo'] ?? null,
                'date' => $validated['date'],
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating event: ' . $e->getMessage());
        }
    
        return redirect()->route('events.index')->with('success', 'Event added successfully!');
    }
    
    
    

    public function update(Request $request, Event $event) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'event_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'date' => 'required|date',
        ]);
    
        if ($request->hasFile('event_photo')) {
            try {
                if ($event->photo) {
                    Storage::disk('public')->delete($event->photo);
                }
    
                $validated['photo'] = $request->file('event_photo')->store('event_photos', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
            }
        } else {
            $validated['photo'] = $event->photo;
        }
    
        try {
            $event->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'photo' => $validated['photo'], 
                'date' => $validated['date'],
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating event: ' . $e->getMessage());
        }
    
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }
    

    public function destroy(Event $event) {

        try {
            $event->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting event: ' . $e->getMessage());
        }

        return back()->with('success', 'Event deleted successfully');
    }
}
