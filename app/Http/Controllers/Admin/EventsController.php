<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Events;
use App\Models\EventRsvp;


class EventsController extends Controller
{
		public function index()
		{
			$events = Events::orderBy('start_datetime', 'desc')->paginate(10);
			return view('admin.events.index', compact('events'));
		}

		public function create()
		{
			return view('admin.events.create');
		}

    public function store(Request $request)
	{
		// Validate first
		$validator = Validator::make($request->all(), [
			'title'          => 'required|string|max:255',
			'description'    => 'nullable|string',
			'venue'          => 'required|in:online,physical',
			'location'       => 'nullable|string|max:255',
			'url'            => 'nullable|url|max:255',
			'start_datetime' => 'required|date',
			'end_datetime'   => 'required|date|after_or_equal:start_datetime',
			'image'          => 'nullable|image|max:2048', // max 2MB
		]);

		// Return back with errors if validation fails
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Default image path
		$imagePath = null;

		// Check and store uploaded image
		if ($request->hasFile('image')) {
			$imagePath = $request->file('image')->store('events', 'public');
		}

		// Create the event
		Events::create([
			'title'          => $request->title,
			'description'    => $request->description,
			'location'       => $request->location,
			'venue'          => $request->venue,
			'url'            => $request->url,
			'start_datetime' => $request->start_datetime,
			'end_datetime'   => $request->end_datetime,
			'image'          => $imagePath,
			'created_by'     => Auth::id(),
		]);

		return redirect()->route('events.index')->with('success', 'Event added successfully!');
	}

    public function edit(Events $event)
		{
			return view('admin.events.edit', compact('event'));
		}

	public function update(Request $request, Events $event)
		{
			$validator = Validator::make($request->all(), [
				'title'          => 'required|string|max:255',
				'description'    => 'nullable|string',
				'venue'          => 'required|in:online,physical',
				'location'       => 'nullable|string|max:255',
				'url'            => 'nullable|url|max:255',
				'start_datetime' => 'required|date',
				'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
				'image'          => 'nullable|image|max:2048', // 2MB max
			]);

			if ($validator->fails()) {
				return redirect()->back()
					->withErrors($validator)
					->withInput();
			}

			$data = $validator->validated();

			// Check if a new image was uploaded
			if ($request->hasFile('image')) {
				// Delete old image if exists
				if ($event->image && \Storage::disk('public')->exists($event->image)) {
					\Storage::disk('public')->delete($event->image);
				}

				// Store new image
				$imagePath = $request->file('image')->store('events', 'public');
				$data['image'] = $imagePath;
			}

			$event->update($data);

			return redirect('/admin/events')->with('success', 'Event updated successfully!');
		}



	public function destroy(Events $event)
		{
			if ($event->status == 1) {
				return redirect()->route('events.index')
								->with('error', 'Cannot delete an active events. Please deactivate it first.');
			}

			$event->delete();
			return redirect()->route('events.index')
							->with('success', 'Event deleted successfully.');
		}
	 public function toggleStatus(Request $request)
    {

        $event = Events::findOrFail($request->id);
        $event->status = $request->status;
        $event->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

		/*public function rsvp($id = null)
		{

			$rsvps = Rsvp::where('event_id', $id)->get();

			return view('admin.events.rsvp_list', [
				'rsvps' => $rsvps,
				'page' => 'RSVP Event',
				'pageName' => 'RSVP Event',
				'main_content' => 'event_rsvp_list',
			]);
		}
            */
    public function rsvp($id = null)
    {
       	 $rsvps = EventRsvp::getAllRsvps($id);
//dd($rsvps);
        return view('admin.events.rsvp_list', [
            'rsvps' => $rsvps,
            'page' => 'RSVP Event',
            'pageName' => 'RSVP Event',
            'main_content' => 'event_rsvp_list',
        ]);
    }

    public function rsvptoggleStatus(Request $request)
    {

        $event = Events::findOrFail($request->id);
        $event->status = $request->status;
        $event->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

}
