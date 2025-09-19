<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use App\Services\NotificationService;
use App\Models\Member;
use App\Services\RecentActivityService;
use App\Rules\NoHtmlOrScript;
class BroadcastController extends Controller
{
    protected $notificationService;
    protected $recentActivityService;

    public function __construct(NotificationService $notificationService, RecentActivityService $recentActivityService)
    {
        $this->notificationService = $notificationService;
        $this->recentActivityService = $recentActivityService;
    }

    public function index()
{
    $broadcasts = Broadcast::orderBy('id', 'desc')->get(); // Fetch all broadcasts
    // print_r($broadcasts); die;// Debugging line to check fetched broadcasts
    return view('admin.broadcasts.index', compact('broadcasts'));
}
    public function store28052025(Request $request)
{
    // dd($request);
    // Validate request
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        'content' => ['required', 'string', new NoHtmlOrScript()],
        'images.*' => 'required|image|max:3072', // 3MB per file
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
        'title' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        'content' => ['required', 'string', new NoHtmlOrScript()],
        'images' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'video_url' => 'nullable|url',
    ], [
        'images.max' => 'File too large. Max allowed is 2MB.',
        'images.mimes' => 'Invalid file type! Accepted: jpg, jpeg, png.',
        'images.file' => 'Please upload a valid file.',
        'video_url.url' => 'Please enter a valid URL.',
    ]);

    // Handle image upload (store first image only if multiple uploaded)
    $imageUrl = null;
  if ($request->hasFile('images')) {
    $image = $request->file('images'); // only first image

 // 1️⃣ Reject double extensions
 $originalName = $image->getClientOriginalName();
 if (substr_count($originalName, '.') > 1) {
     return back()->withErrors([
         'images' => 'Invalid file name! Double extensions are not allowed.'
     ]);
 }

    $extension = strtolower($image->getClientOriginalExtension());
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($extension, $allowed)) {
        return back()->withErrors(['images' => 'Invalid file type!']);
    }
    // ✅ generate dynamic safe filename
    $filename = uniqid('img_', true) . '.' . $image->getClientOriginalExtension();
    $imageUrl = $image->storeAs('uploads/broadcasts', $filename, 'public');
}

    // Save to DB
    $broadcast = Broadcast::create([
        'title' => $validated['title'],
        'description' => $validated['content'],
        'image_url' => $imageUrl, // just the path like "uploads/broadcasts/filename.png"
        'video_url' => $validated['video_url'] ?? null,
        'createdBy' => auth()->id() ?? null,
        'is_deleted' => 0,
        'deleted_on' => null,
    ]);

    $this->recentActivityService->logActivity(
        'New Broadcast Created',
        'Broadcast',
        auth()->guard('admin')->id(),
        'Created new broadcast: ' . $broadcast->title,
        1,
        $broadcast->id
    );

    if($broadcast){
       $notification = $this->notificationService->notifyAllMembers('broadcast', $broadcast->title . ' broadcast has been added.', $broadcast->id, 'broadcast', auth()->id());
    }

    return redirect()->route('broadcasts.index')->with('success', 'Broadcast added successfully!');
}

public function toggleStatus(Request $request)
{
    $broadcast = Broadcast::findOrFail($request->id);
    $oldStatus = $broadcast->status;
    $broadcast->status = $request->status;
    $broadcast->save();

    if ($oldStatus == 0 && $broadcast->status == 1) {
        $notification = $this->notificationService->notifyAllMembers('broadcast', $broadcast->title . ' Broadcast has been activated.', $broadcast->id, 'broadcast', auth()->id());
    }

    if ($oldStatus == 1 && $broadcast->status == 0) {
        // Notify members about deactivation
        $notification = $this->notificationService->notifyAllMembers('broadcast', $broadcast->title . ' Broadcast has been deactivated.', $broadcast->id, 'broadcast_deactivated', auth()->id());
    }

    $this->recentActivityService->logActivity(
        'Broadcast Status Toggled',
        'Broadcast',
        auth()->guard('admin')->id(),
        'Toggled status for broadcast: ' . $broadcast->title .' to ' . ($broadcast->status == 1 ? 'active' : 'inactive'),
        1,
        $broadcast->id
    );

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
        $data=$broadcast->delete();

        if($data){
            // Notify members about the broadcast deletion
            $notification = $this->notificationService->notifyAllMembers('broadcast', $broadcast->title . ' broadcast has been deleted.', $broadcast->id, 'broadcast_deleted', auth()->id());
        }

        $this->recentActivityService->logActivity(
            'Broadcast Deleted',
            'Broadcast',
            auth()->guard('admin')->id(),
            'Deleted broadcast: ' . $broadcast->title,
            1,
            $broadcast->id
        );
        return redirect()->route('broadcasts.index')->with('success', 'Broadcast deleted successfully.');
    }
    public function update(Request $request, $id)
{
    $broadcast = Broadcast::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'video_url' => 'nullable|url',
    ],[
        'image.max' => 'File too large. Max allowed is 2MB.',
        'image.mimes' => 'Invalid file type! Accepted: jpg, jpeg, png.',
        'image.file' => 'Please upload a valid file.',
        'video_url.url' => 'Please enter a valid URL.',
    ]);


    // Image upload
   if ($request->hasFile('image')) {
    $file = $request->file('image');
    $extension = strtolower($file->getClientOriginalExtension());
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowed)) {
        return back()->withErrors(['image' => 'Invalid file type!']);
    }

    // 1) Reject double extensions
    $originalName = $file->getClientOriginalName();
    if (substr_count($originalName, '.') > 1) {
        return back()->withErrors([
            'image' => 'Invalid file name! Double extensions are not allowed.'
        ])->withInput();
    }

    $extension = strtolower($file->getClientOriginalExtension());
    $allowed = ['jpg', 'jpeg', 'png'];
    if (!in_array($extension, $allowed)) {
        return back()->withErrors(['image' => 'Invalid file type!'])->withInput();
    }

    // Generate safe unique filename and store
    $filename = uniqid('img_', true) . '.' . $extension;
    $path = $file->storeAs('uploads/broadcasts', $filename, 'public');

    // Save only relative path; use asset() when rendering
    $broadcast->image_url = $path;
}

    $broadcast->title = $validated['title'];
    $broadcast->description = $validated['description'];
    $broadcast->video_url = $validated['video_url'] ?? null;

    $result = $broadcast->save();

    if ($result && $broadcast->status == 1) {
        $notification = $this->notificationService->notifyAllMembers('broadcast', $broadcast->title . ' broadcast has been updated.', $broadcast->id, 'broadcast', auth()->id());
    }

    $this->recentActivityService->logActivity(
        'Broadcast Updated',
        'Broadcast',
        auth()->guard('admin')->id(),
        'Updated broadcast: ' . $broadcast->title,
        1,
        $broadcast->id
    );
    return redirect()->back()->with('success', 'Broadcast updated successfully.');
}

}
