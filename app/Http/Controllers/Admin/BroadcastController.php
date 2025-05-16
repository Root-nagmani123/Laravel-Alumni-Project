<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broadcast;
class BroadcastController extends Controller
{
    public function index()
{
    $broadcasts = Broadcast::orderBy('created_at', 'desc')->get(); // Fetch all broadcasts
    return view('admin.broadcasts.index', compact('broadcasts'));
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
        $imageUrl = $image->store('uploads/broadcasts', 'public');
    }

    // Save to DB
    $broadcast = Broadcast::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'image_url' => $imageUrl ? asset('storage/' . $imageUrl) : null,
        'video_url' => $validated['video_url'] ?? null,
        'createdBy' => auth()->id() ?? null,
        'is_deleted' => 0,
        'deleted_on' => now(), // default to now, or update logic as needed
    ]);

    return redirect()->route('broadcasts.index')->with('success', 'Broadcast added successfully!');
    
}
public function toggleStatus(Request $request)
{
    $broadcast = Broadcast::findOrFail($request->id);
    $broadcast->status = $request->status;
    $broadcast->save();

    return response()->json(['message' => 'Broadcast status updated successfully.']);
}
public function destroy(Broadcast $broadcast)
    {
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
        $path = $request->file('image')->store('uploads/broadcasts', 'public');
        $broadcast->image_url = asset('storage/' . $path);
    }

    $broadcast->title = $validated['title'];
    $broadcast->description = $validated['description'];
    $broadcast->video_url = $validated['video_url'] ?? null;

    $broadcast->save();

    return redirect()->back()->with('success', 'Broadcast updated successfully.');
}

}
