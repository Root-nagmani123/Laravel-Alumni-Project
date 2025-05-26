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
    // Validation
    $validator = Validator::make($request->all(), [
        'title'          => 'required|string|max:255',
        'description'    => 'nullable|string',
        'location'       => 'nullable|string|max:255',
        'venue'          => 'required|in:online,physical',
        'url'            => 'nullable|url|max:255',
        'start_datetime' => 'required|date',
        'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Create Event
    $event = new Events();
    $event->title          = $request->title;
    $event->description    = $request->description;
    $event->location       = $request->location;
    $event->venue          = $request->venue;
    $event->url            = $request->url;
    $event->start_datetime = $request->start_datetime;
    $event->end_datetime   = $request->end_datetime;
    $event->created_by     = Auth::id();
    $event->save();

    /*
Events::create([
    'title'          => $request->title,
    'description'    => $request->description,
    'location'       => $request->location,
    'venue'          => $request->venue,
    'url'            => $request->url,
    'start_datetime' => $request->start_datetime,
    'end_datetime'   => $request->end_datetime,
    'created_by'     => Auth::id(),
]);
    */


    return redirect('/admin/events')->with('success', 'Event added successfully!');
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
        'location'       => 'nullable|string|max:255',
        'start_datetime' => 'required|date',
        'end_datetime'   => 'nullable|date|after_or_equal:start_datetime',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $event->update($validator->validated());

    //return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');

//return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
 return redirect('/admin/events')->with('success', 'Event updated successfully!');


}



    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
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
        $rsvps = EventRsvp::where('event_id', $id)->get();

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
