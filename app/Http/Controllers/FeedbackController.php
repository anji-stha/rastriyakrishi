<?php

namespace App\Http\Controllers;

use App\Models\ExistingUser;
use App\Models\Feedback;
use App\Models\NewUser;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function submit(Request $request)
    {
        $registrationType = $request->input('registration_type');
        $newUserRules = [
            'full_name' => 'required|string|max:255',
            'dob_bs' => 'required|string',
            'dob_ad' => 'required|string',
            'citizenship_no' => 'required|string|max:50',
            'citizenship_issued' => 'required|string|max:50',
            'citizenship_district' => 'required|string|max:100',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'citizenship' => $request->is_minor ? 'nullable|file|mimes:jpg,jpeg,png|max:2048' : 'required|file|mimes:jpg,jpeg,png|max:2048',
            'is_minor' => 'nullable|boolean',
            'minor_father_name' => 'required_if:is_minor,1',
            'parent_district' => 'required_if:is_minor,1',
            'parent_municipality' => 'required_if:is_minor,1',
            'parent_ward_no' => 'required_if:is_minor,1',
            'parent_tole' => 'required_if:is_minor,1',
            'parent_citizenship' => 'required_if:is_minor,1|file|mimes:jpeg,jpg,png|max:2048',
            'minor_guardian_relation' => 'required_if:is_minor,1',
            'minor_guardian_bank_name' => 'required_if:is_minor,1',
            'minor_guardian_bank_account_number' => 'required_if:is_minor,1',
            'national_id_no' => $request->is_minor ? 'nullable|string' : 'required|string',
            'national_id' => $request->is_minor ? 'nullable|file|mimes:jpg,jpeg,png|max:2048' : 'required|file|mimes:jpg,jpeg,png|max:2048',
            'birth_citizenship' => 'required_if:is_minor,1|file|mimes:jpeg,jpg,png|max:2048',
        ];

        $commonRules = [
            'permanent_district' => 'required|string|max:100',
            'permanent_municipality' => 'required|string|max:100',
            'permanent_ward_no' => 'required|string|max:100',
            'permanent_tole' => 'required|string|max:255',
            'federal_province' => 'nullable|string|max:100',
            'federal_district' => 'nullable|string|max:100',
            'federal_municipality' => 'nullable|string|max:100',
            'federal_ward_no' => 'nullable|string|max:100',
            'federal_tole' => 'nullable|string|max:100',
            'federal_house_no' => 'nullable|string|max:100',
            'temporary_province' => 'nullable|string|max:100',
            'temporary_district' => 'nullable|string|max:100',
            'temporary_municipality' => 'nullable|string|max:100',
            'temporary_ward_no' => 'nullable|string|max:100',
            'temporary_tole' => 'nullable|string|max:100',
            'temporary_house_no' => 'nullable|string|max:100',
            'email' => 'required|email|max:255',
            'mobile' => 'required|digits_between:7,10',
            'father_name' => 'nullable|string|max:255',
            'grandfather_name' => 'nullable|string|max:255',
            'spouse_name' => 'nullable|string|max:255',
            'relation_type' => 'nullable|string|in:grandfather,father_in_law',
            'spouse_relation' => 'nullable|string|in:husband,wife',
            'payment_method' => 'required|string|in:cash,cheque,bankDeposit,ips',
            'pan' => 'nullable|string|max:15',
            'education_level' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'organization_address' => 'nullable|string|max:255',
            'share' => 'nullable|numeric',
            'investment_amount' => 'nullable|numeric',
            'amount_in_words' => 'nullable|string|max:255',
            'accept_terms' => 'accepted',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'voucher' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];

        $existingRules = [
            'registration_number' => 'required_if:registration_type,existing'
        ];

        try {
            $validated = $request->validate(
                $registrationType === 'new'
                    ? array_merge($newUserRules, $commonRules)
                    : array_merge($existingRules, $commonRules)
            );

            $validated['accept_terms'] = $request->has('accept_terms') ? 1 : 0;

            // Handle the image upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('uploads/photos', 'public');
                $validated['photo'] = $photoPath;
            }

            if ($request->hasFile('citizenship')) {
                $citizenshipPath = $request->file('citizenship')->store('uploads/citizenships', 'public');
                $validated['citizenship'] = $citizenshipPath;
            }

            if ($request->hasFile('signature')) {
                $signaturePath = $request->file('signature')->store('uploads/signatures', 'public');
                $validated['signature'] = $signaturePath;
            }

            if ($request->hasFile('voucher')) {
                $voucherPath = $request->file('voucher')->store('uploads/vouchers', 'public');
                $validated['voucher'] = $voucherPath;
            }

            if ($request->hasFile('parent_citizenship')) {
                $filePath = $request->file('parent_citizenship')->store('uploads/parent_citizenships', 'public');
                $validated['parent_citizenship'] = $filePath;
            }

            if ($request->hasFile('m_parent_citizenship')) {
                $filePath = $request->file('m_parent_citizenship')->store('uploads/parent_citizenships', 'public');
                $validated['m_parent_citizenship'] = $filePath;
            }

            if ($request->hasFile('national_id')) {
                $filePath = $request->file('national_id')->store('uploads/national_id', 'public');
                $validated['national_id'] = $filePath;
            }

            if ($registrationType === 'new') {
                NewUser::create($validated);
            } else {
                ExistingUser::create($validated);
            }

            return response()->json(['message' => 'Form submitted successfully!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::debug($e->validator->errors());
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }
}
