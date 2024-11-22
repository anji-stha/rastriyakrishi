<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = FAQ::paginate(10);
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'questions.*' => 'required|string',
            'answers.*' => 'required|string',
        ]);

        foreach ($request->questions as $index => $question) {
            FAQ::create([
                'question' => $question,
                'answer' => $request->answers[$index],
            ]);
        }

        return redirect()->route('faqs.index')->with('success', 'FAQs added successfully.');
    }

    public function show(FAQ $faq)
    {
        return view('faqs.show', compact('faq'));
    }

    public function edit(FAQ $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function faqs()
    {
        $faqs = FAQ::paginate(10);
        return view('faqs.public.index', compact('faqs'));
    }
}
