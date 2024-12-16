<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index() {
        $event = Event::paginate(6);

        if (!Auth::check()) {
            return view('events', [
                'events' => $event,
            ]);
        }

        $role = Auth::user()->isAdmin ? 'admin' : 'user';
        $view = $role === 'admin' ? 'admin.events' : 'events';

        return view($view, [
            'events' => $event,
        ]);

        // return $event;
    }

    public function store(Request $request) {
        //role auth

        //validate request
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'date' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            try {
                $validated['photo'] = $request->file('photo')->store('photos');
            } catch (\Exception $e) {
                return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
            }
        }

        //try to save the event
        try {
            $event = Event::create($validated);
        } catch (\Exception $e) {
            // return response()->json([
            //     'message' => 'Error creating event',
            //     'error' => $e->getMessage(),
            // ], 500);

            return back()->with('error', 'Error creating event: ' . $e->getMessage());
        }

        //return the event

        return $event;
    }

    public function update(Request $request, Event $event) {
        //role auth

        //validate request
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'location' => 'required',
            'date' => 'required',
        ]);
        //check if there is a photo
        if ($request->hasFile('photo')) {
            try {
                if ($event->photo) {
                    Storage::delete($event->photo);
                }

                $validated['photo'] = $request->file('photo')->store('photos');
            } catch (\Exception $e) {
                return back()->with('error', 'Error uploading photo: ' . $e->getMessage());
            }
        }

        //try to update the event
        try {
            $event->update($validated);
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating event: ' . $e->getMessage());
        }

        //return the event
        return $event;
    }

    public function destroy(Event $event) {
        //role auth

        //try to delete the event
        try {
            $event->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting event: ' . $e->getMessage());
        }

        //return success message
        return back()->with('success', 'Event deleted successfully');
    }
}
