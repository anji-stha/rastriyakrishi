<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class NoticeController extends Controller
{
    public function index()
    {
        // Paginate notices and pass them to the view
        $notices = Notice::orderBy('created_at')->paginate(10);
        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        return view('notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('uploads/notice', 'public') : null;

        Notice::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully.');
    }

    public function show($id)
    {
        $notice = Notice::findOrFail($id); // Fetch the notice by ID or fail if not found
        return view('notices.show', compact('notice')); // Pass the notice data to the view
    }

    public function edit(Notice $notice)
    {
        return view('notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($notice->image && Storage::exists($notice->image)) {
                Storage::delete($notice->image);
            }

            $imagePath = $request->file('image')->store('uploads/photos', 'public');
        } else {
            $imagePath = $notice->image;
        }

        $notice->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        // Delete image if exists
        if ($notice->image && Storage::exists($notice->image)) {
            Storage::delete($notice->image);
        }

        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }

    public function notices()
    {
        $notices = Notice::where('status', 'active')->paginate(10);
        return view('notices.public.index', compact('notices'));
    }
}
