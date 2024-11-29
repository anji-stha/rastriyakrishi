<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackResponse;
use App\Models\ExistingUser;
use App\Models\NewUser;
use App\Models\ShareRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getNewUsers(Request $request)
    {
        $query = NewUser::query();
        if ($request->filled('full_name')) {
            $query->where('full_name', 'like', '%' . $request->full_name . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('is_minor')) {
            $query->where('is_minor', $request->is_minor);
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        // Paginate the results
        $newUser = $query->paginate(20);

        // Check if request is AJAX
        if ($request->ajax()) {
            return view('admin.partials.newuser', compact('newUser'))->render();
        }
        return view('admin.partials.newuser', compact('newUser'));
    }

    public function getExistingUsers(Request $request)
    {
        $query = ExistingUser::query();

        // Apply filters if present
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        // Paginate the results
        $existingUser = $query->paginate(20);

        // Check if request is AJAX
        if ($request->ajax()) {
            return view('admin.partials.existinguser', compact('existingUser'))->render();
        }

        return view('admin.partials.existinguser', compact('existingUser'));
    }

    public function approve($id, $type)
    {
        $data = null;

        if ($type === 'existing') {
            $data = ExistingUser::findOrFail($id);
        } elseif ($type === 'new') {
            $data = NewUser::findOrFail($id);
            // Generate a unique registration number only for new registrations
            $data->registration_number = 'REG' . mt_rand(100000, 999999);
        }

        if ($data) {
            $data->status = 'approved';
            $data->save();

            $registrationNumber = $type === 'new' ? $data->registration_number : null;

            Mail::to($data->email)->send(new FeedbackResponse('approved', $registrationNumber));

            return redirect()->route('admin.dashboard')->with('success', 'Form approved successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Approval failed.');
    }

    public function disapprove($id, $type)
    {
        $data = null;

        if ($type === 'existing') {
            $data = ExistingUser::findOrFail($id);
        } elseif ($type === 'new') {
            $data = NewUser::findOrFail($id);
        }

        if ($data) {
            $data->status = 'disapproved';
            $data->save();

            Mail::to($data->email)->send(new FeedbackResponse('disapproved', ''));

            return redirect()->route('admin.dashboard')->with('success', 'Form disapproved successfully!');
        }

        return redirect()->route('admin.dashboard')->with('error', 'Disapproval failed.');
    }

    public function show($id, $type)
    {
        if ($type === 'existing') {
            $data = ExistingUser::findOrFail($id);
        } elseif ($type === 'new') {
            $data = NewUser::findOrFail($id);
        } else {
            return redirect()->route('admin.existingusers')->withErrors('Invalid user type.');
        }

        return view('admin.view', [
            'user' => $data,
            'type' => $type
        ]);
    }

    public function search($registrationNumber)
    {
        $user = NewUser::where('registration_number', $registrationNumber)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'data' => $user->only([
                    'permanent_district',
                    'permanent_municipality',
                    'permanent_tole',
                    'permanent_ward_no',
                    'temporary_district',
                    'temporary_house_no',
                    'temporary_municipality',
                    'temporary_province',
                    'temporary_tole',
                    'temporary_ward_no',
                    'federal_district',
                    'federal_house_no',
                    'federal_municipality',
                    'federal_province',
                    'federal_tole',
                    'federal_ward_no',
                    'email',
                    'mobile',
                    'father_name',
                    'relation_type',
                    'grandfather_name',
                    'spouse_relation',
                    'spouse_name',
                    'payment_method',
                    'pan',
                    'education_level',
                    'degree',
                    'share',
                    'investment_amount',
                    'amount_in_words',
                    'profession',
                    'organization',
                    'organization_address',
                    'accept_terms',
                    'bank_name',
                    'bank_branch',
                    'account_holder_name',
                    'account_number'
                ])
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No user found with this registration number.',
        ]);
    }

    public function showShareRateForm()
    {
        $shareRate = ShareRate::first();
        return view('share-rates.index', compact('shareRate'));
    }

    public function setShareRate(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|numeric|min:0',
        ]);

        $shareRate = ShareRate::first();
        if (!$shareRate) {
            $shareRate = new ShareRate();
        }

        $shareRate->rate = $validated['rate'];
        $shareRate->save();

        return redirect()->back()->with('success', 'Share rate updated successfully!');
    }

    public function downloadFile(Request $request)
    {
        $field = $request->get('field');
        $filePath = $request->get('file_path');

        $fileFields = [
            'photo' => 'uploads/photos',
            'citizenship' => 'uploads/citizenships',
            'signature' => 'uploads/signatures',
            'voucher' => 'uploads/vouchers',
            'parent_citizenship' => 'uploads/parent_citizenships',
            'national_id' => 'uploads/national_id',
            'birth_certificate' => 'uploads/birth_certificate',
        ];

        // Check if the field exists in the fileFields array or if the filePath is empty
        if (!array_key_exists($field, $fileFields) || !$filePath) {
            return redirect()->back()->with('error', 'Invalid download request');
        }

        // Check if the file exists in the public storage
        if (!Storage::disk('public')->exists($filePath)) {
            return response()->back()->with('error', 'File not found');
        }

        return Storage::disk('public')->download($filePath);
    }
}
