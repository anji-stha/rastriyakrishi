<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrochureController extends Controller
{
    public function index()
    {
        $files = Storage::disk('public')->files('brochures') ?? [];

        return view('brochure.index', compact('files'));
    }

    public function showUpload()
    {
        return view('brochure.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'brochure' => 'required|file|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '_' . $request->file('brochure')->getClientOriginalName();

        $path = $request->file('brochure')->storeAs('brochures', $fileName, 'public');

        return back()->with('success', "Brochure uploaded successfully!");
    }

    public function view($filename)
    {
        $path = public_path('storage/brochures/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        }

        return redirect()->route('brochure.index')->with('error', 'File not found.');
    }

    public function download($filename)
    {
        $path = public_path('storage/brochures/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        }

        return redirect()->route('brochure.index')->with('error', 'File not found.');
    }


    public function delete($filename)
    {
        $path = public_path('storage/brochures/' . $filename);

        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('brochure.index')->with('success', 'Brochure deleted successfully.');
        }

        return redirect()->route('brochure.index')->with('error', 'File not found.');
    }

    public function viewBrochure($filename)
    {
        $path = public_path('storage/resources/' . $filename); // Path to the resource file
        if (file_exists($path)) {
            return response()->file($path);  // Return the file for viewing
        }

        return redirect()->route('home')->with('error', 'File not found.');
    }

    public function downloadBrochure($filename)
    {
        $path = public_path('storage/resources/' . $filename); // Path to the resource file
        if (file_exists($path)) {
            return response()->download($path);  // Return the file for downloading
        }

        return redirect()->route('home')->with('error', 'File not found.');
    }

}
