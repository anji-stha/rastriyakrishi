<?php

namespace App\Http\Controllers;

use App\Models\ExistingUser;
use App\Models\Feedback;
use App\Models\NewUser;
use App\Models\ShareRate;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $shareRate = ShareRate::first();
        return view('home', [
            'shareRate' => $shareRate
        ]);
    }

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
            'birth_certificate' => 'required_if:is_minor,1|file|mimes:jpeg,jpg,png|max:2048',
            'share_initial' => 'required|numeric',
            'investment_amount_initial' => 'nullable|numeric',
            'amount_in_words_initial' => 'nullable|string|max:255',
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
            'share' => 'required|numeric',
            'investment_amount' => 'nullable|numeric',
            'amount_in_words' => 'nullable|string|max:255',
            'accept_terms' => 'accepted',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'voucher' => 'required_if:payment_method,cheque,bankDeposit,ips|file|mimes:jpg,jpeg,png|max:2048',
            'bank_name' => 'required_if:payment_method,cheque',
            'bank_branch' => 'required_if:payment_method,cheque',
            'account_holder_name' => 'required_if:payment_method,cheque',
            'account_number' => 'required_if:payment_method,cheque',
            'referred_by' => 'nullable|string',
            'terms_conditions' => 'accepted',
            'cheque_no' => 'required_if:payment_method,cheque',
            'cheque_amount' => 'required_if:payment_method,cheque',
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

            $validated['registration_number'] = $registrationType === 'new'
                ? 'temporary' . uniqid()
                : $request->input('registration_number');

            $validated['accept_terms'] = $request->has('accept_terms') ? 1 : 0;
            $validated['terms_conditions'] = $request->has('terms_conditions') ? 1 : 0;

            $validated['is_exist'] = $registrationType === 'existing' ? 1 : 0;

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

            if ($request->hasFile('birth_certificate')) {
                $filePath = $request->file('birth_certificate')->store('uploads/birth_certificate', 'public');
                $validated['birth_certificate'] = $filePath;
            }

            $newUser = NewUser::create($validated);

            $investmentDetailsData = [
                'registration_number' => $validated['registration_number'],
                'share' => $validated['share'],
                'amount_in_words' => $validated['amount_in_words'],
                'investment_amount' => $validated['investment_amount'],
                'share_initial' => $validated['share_initial'] ?? 0.00,
                'amount_in_words_initial' => $validated['amount_in_words_initial'] ?? '',
                'investment_amount_initial' => $validated['investment_amount_initial'] ?? 0.00,
                'new_user_id' => $newUser->id,
            ];

            // Insert investment details
            $newUser->investmentDetails()->create($investmentDetailsData);

            return response()->json(['message' => 'Form submitted successfully!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::debug($e->validator->errors());
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }
}
