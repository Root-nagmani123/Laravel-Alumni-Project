<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use App\Services\NotificationService;
use App\Models\Member;
class BroadcastController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    public function index()
{
    $broadcasts = Broadcast::orderBy('id', 'desc')->get(); // Fetch all broadcasts
    return view('admin.broadcasts.index', compact('broadcasts'));
}
    public function store28052025(Request $request)
{
    // dd($request);
    // Validate request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'images.*' => 'nullable|image|max:3072', // 3MB per file
        'video_url' => 'nullable|url',
    ]);

    // Handle image upload (store first image only if multiple uploaded)
    $imageUrl = null;
    if ($request->hasFile('images')) {
        $image = $request->file('images')[0];
        //$imageUrl = $image->store('uploads/broadcasts', 'public');
         $path = $image->storeAs('uploads/broadcasts', $image, 'public');
         $imageUrl = $path;

    }

    // Save to DB
    $broadcast = Broadcast::create([
        'title' => $validated['title'],
        'description' => $validated['content'],
        //'image_url' => $imageUrl ? asset('storage/' . $imageUrl) : null,
        'image_url' => $imageUrl ? asset('storage/' . $imageUrl) : null,
        'video_url' => $validated['video_url'] ?? null,
        'createdBy' => auth()->id() ?? null,
        'is_deleted' => 0,
        'deleted_on' => now(),
    ]);

    return redirect()->route('broadcasts.index')->with('success', 'Broadcast added successfully!');

}

public function store(Request $request)
{
    // Validate request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'images.*' => 'nullable|image|max:3072', // 3MB per file
        'video_url' => 'nullable|url',
    ]);

    // Handle image upload (store first image only if multiple uploaded)
    $imageUrl = null;
    if ($request->hasFile('images')) {
        $image = $request->file('images')[0];
        $imageUrl = $image->store('uploads/broadcasts', 'public'); // returns relative path
    }

    // Save to DB
    $broadcast = Broadcast::create([
        'title' => $validated['title'],
        'description' => $validated['content'],
        'image_url' => $imageUrl, // just the path like "uploads/broadcasts/filename.png"
        'video_url' => $validated['video_url'] ?? null,
        'createdBy' => auth()->id() ?? null,
        'is_deleted' => 0,
        'deleted_on' => now(),
    ]);

    //notification 
    if($broadcast){

       $notification = $this->notificationService->notifyAllMembers('broadcast', 'New broadcast has been added.', $broadcast->id, 'broadcast');
       
       if($notification){
        Member::query()->update(['is_notification' => 0]);
       }
    }

    return redirect()->route('broadcasts.index')->with('success', 'Broadcast added successfully!');
}

public function toggleStatus(Request $request)
{
    $broadcast = Broadcast::findOrFail($request->id);
    $broadcast->status = $request->status;
    $broadcast->save();

    return response()->json(['message' => 'Status updated successfully.']);
}
public function destroybroadcast(Broadcast $broadcast)
    {
         if ($broadcast->status == 1) {
            return redirect()->route('broadcasts.index')
                            ->with('error', 'Cannot delete an active Broadcast. Please deactivate it first.');
        }

        if ($broadcast->image_url && Storage::disk('public')->exists($broadcast->image_url))
        Storage::disk('public')->delete($broadcast->image_url);
        $broadcast->delete();
        return redirect()->route('broadcasts.index')->with('success', 'Broadcast deleted successfully.');
    }
    public function update(Request $request, $id)
{
    $broadcast = Broadcast::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:3072',
        'video_url' => 'nullable|url',
    ]);

    // Image upload
   if ($request->hasFile('image')) {
    $file = $request->file('image');

    // Sanitize filename
    $originalName = $file->getClientOriginalName();
    $safeName = preg_replace('/[^a-zA-Z0-9\._-]/', '', pathinfo($originalName, PATHINFO_FILENAME));
    $extension = $file->getClientOriginalExtension();
    $finalFileName = $safeName . '_' . time() . '.' . $extension;

    // Store in desired location with custom filename
    $path = $file->storeAs('uploads/broadcasts', $finalFileName, 'public');

    // Save only relative path; use asset() when rendering
    $broadcast->image_url = $path;
}

    $broadcast->title = $validated['title'];
    $broadcast->description = $validated['description'];
    $broadcast->video_url = $validated['video_url'] ?? null;

    $broadcast->save();

    return redirect()->back()->with('success', 'Broadcast updated successfully.');
}

}
