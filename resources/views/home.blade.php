@extends('layout.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
            </div>

            <div class="col-md-8 text-right pt-1">
                <a href="https://rastriyakrishi.com.np/" style="color:#F57921; "><i class="bi bi-arrow-left-circle"></i> Go to
                    Homepage</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 style="color:#22B24B;">Application Form</h2>
        <p>Please fill up the below form to apply.</p>
    </div>

    <div class="container">

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div id="responseMessage"></div>
    </div>

    <!-- Form Start -->
    <form action="{{ route('feedback.submit') }}" method="POST" enctype="multipart/form-data" id="registration-form">
        @csrf

        <div class="container mt-4">
            <fieldset class="border p-4 mb-4">
                <legend class="w-auto">Select Registration Type</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="registration_type" id="new_registration"
                        value="new">
                    <label class="form-check-label" for="new_registration">
                        New Registration
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="registration_type" id="existing_registration"
                        value="existing">
                    <label class="form-check-label" for="existing_registration">
                        Existing Registration
                    </label>
                </div>
            </fieldset>
        </div>

        <div id="form-container">
            <!-- Personal Information Section -->
            <div id="new-form-fields">
                <div class="container mt-4">
                    <fieldset class="border p-4 mb-4">
                        <legend class="w-auto"> 1. Personal Information </legend>
                        <div class="row">
                            <div class="col-md-9">

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="full_name">1. Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name"
                                        placeholder="Full Name" value="{{ old('full_name') }}">
                                    <span class="text-danger error-message" id="error-full_name"></span>
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label for="dob_bs">2. Date of Birth</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="dob_bs" name="dob_bs"
                                            placeholder="B.S." value="{{ old('dob_bs') }}">

                                        <input type="text" class="form-control" id="dob_ad" name="dob_ad"
                                            placeholder="A.D." value="{{ old('dob_ad') }}">
                                    </div>
                                    <span class="text-danger error-message" id="error-dob_bs"></span>
                                    <span class="text-danger error-message" id="error-dob_ad"></span>
                                </div>

                                <!-- Citizenship Details -->
                                <div class="form-group">
                                    <label for="citizenship_no">3. Citizenship Details</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="citizenship_no" name="citizenship_no"
                                            placeholder="No." value="{{ old('citizenship_no') }}">
                                        <input type="text" class="form-control" id="citizenship_no"
                                            name="citizenship_issued" placeholder="Issued Date"
                                            value="{{ old('citizenship_issued') }}">
                                        <input type="text" class="form-control" id="citizenship_district"
                                            name="citizenship_district" placeholder="District"
                                            value="{{ old('citizenship_district') }}">
                                    </div>
                                    <span class="text-danger error-message" id="error-citizenship_no"></span>
                                    <span class="text-danger error-message" id="error-citizenship_issued"></span>
                                    <span class="text-danger error-message" id="error-citizenship_district"></span>
                                </div>

                                <div class="form-group">
                                    <label for="national_id_no">4. National ID Number</label>
                                    <input type="text" class="form-control" id="national_id_no" name="national_id_no"
                                        placeholder="National ID Number" value="{{ old('national_id_no') }}">
                                    <span class="text-danger error-message" id="error-national_id_no"></span>
                                </div>
                            </div>

                            <!-- File Uploads -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="photo">Photo <small class="text-muted">(Max size: 2MB)</small></label>
                                    <input type="file" class="form-control-file" id="photo" name="photo"
                                        value="{{ old('photo') }}">
                                    <span class="text-danger error-message" id="error-photo"></span>
                                </div>
                                <div class="form-group">
                                    <label for="citizenship">Citizenship <small class="text-muted">(Max size:
                                            2MB)</small></label>
                                    <input type="file" class="form-control-file" id="citizenship" name="citizenship"
                                        value="{{ old('citizenship') }}">
                                    <span class="text-danger error-message" id="error-citizenship"></span>
                                </div>
                                <div class="form-group">
                                    <label for="national_id">National ID <small class="text-muted">(Max size:
                                            2MB)</small></label>
                                    <input type="file" class="form-control-file" id="national_id" name="national_id"
                                        value="{{ old('national_id') }}">
                                    <span class="text-danger error-message" id="error-national_id"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                {{-- Minor section --}}
                <div class="container mt-4">
                    <fieldset class="border p-4 mb-4">
                        <legend class="w-auto">2. Are you a minor?</legend>

                        <div class="form-group">
                            <!-- Hidden input to send 0 when checkbox is unchecked -->
                            <input type="hidden" name="is_minor" value="0">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_minor" name="is_minor"
                                    value="1" {{ old('is_minor') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_minor">Yes, I am a minor</label>
                            </div>
                        </div>

                        <!-- Parent Details (Hidden Initially) -->
                        <div id="parent-details" style="display: none;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="minor_father_name">Guardian's Name</label>
                                        <input type="text" class="form-control" id="minor_father_name"
                                            name="minor_father_name" placeholder="Guardian's Name"
                                            value="{{ old('minor_father_name') }}">
                                        <span class="text-danger error-message" id="error-minor_father_name"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="parent_district"> Guardian's Address (According to Citizenship of
                                            Guardian)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="parent_district"
                                                name="parent_district" placeholder="District"
                                                value="{{ old('parent_district') }}">
                                            <input type="text" class="form-control" id="parent_municipality"
                                                name="parent_municipality" placeholder="Municipality/VDC"
                                                value="{{ old('parent_municipality') }}">
                                            <input type="text" class="form-control" id="parent_ward_no"
                                                name="parent_ward_no" placeholder="Ward No."
                                                value="{{ old('parent_ward_no') }}">
                                            <input type="text" class="form-control" id="parent_tole"
                                                name="parent_tole" placeholder="Tole" value="{{ old('parent_tole') }}">
                                        </div>
                                        <span class="text-danger error-message" id="error-parent_district"></span>
                                        <span class="text-danger error-message" id="error-parent_municipality"></span>
                                        <span class="text-danger error-message" id="error-parent_ward_no"></span>
                                        <span class="text-danger error-message" id="error-parent_tole"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="minor_guardian_relation">Guardian's Relation</label>
                                        <input type="text" class="form-control" id="minor_guardian_relation"
                                            name="minor_guardian_relation" placeholder="Guardian's Relation"
                                            value="{{ old('minor_guardian_relation') }}">
                                        <span class="text-danger error-message" id="error-minor_guardian_relation"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="minor_guardian_bank_name">Guardian's Bank Name</label>
                                        <input type="text" class="form-control" id="minor_guardian_bank_name"
                                            name="minor_guardian_bank_name" placeholder="Guardian's Bank Name"
                                            value="{{ old('minor_guardian_bank_name') }}">
                                        <span class="text-danger error-message"
                                            id="error-minor_guardian_bank_name"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="minor_guardian_bank_account_number">Guardian's Bank Account
                                            Number</label>
                                        <input type="text" class="form-control"
                                            id="minor_guardian_bank_account_number"
                                            name="minor_guardian_bank_account_number"
                                            placeholder="Guardian's Bank Account Number"
                                            value="{{ old('minor_guardian_bank_account_number') }}">
                                        <span class="text-danger error-message"
                                            id="error-minor_guardian_bank_account_number"></span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="parent_citizenship">Guardian's Citizenship Photo <small
                                                    class="text-muted">(Max size: 2MB)</small></label>
                                            <input type="file" class="form-control" id="parent_citizenship"
                                                name="parent_citizenship" value="{{ old('parent_citizenship') }}">
                                            <span class="text-danger error-message" id="error-parent_citizenship"></span>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="birth_citizenship">Birth Certificate <small
                                                    class="text-muted">(Max size: 2MB)</small></label>
                                            <input type="file" class="form-control" id="birth_citizenship"
                                                name="birth_citizenship" value="{{ old('birth_citizenship') }}">
                                            <span class="text-danger error-message" id="error-birth_citizenship"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div id="existing-form-fields" class="container mt-4">
                {{-- Registration Number --}}
                <div id="existing-fields" class="form-group">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number"
                        placeholder="Enter registration number">
                    <span class="text-danger error-message" id="error-registration_number"></span>
                </div>
                <!-- Address Details Section -->
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">3. Address Details</legend>
                    <!-- Permanent Address -->
                    <div class="form-group">
                        <label for="permanent_district">a) Permanent Address (According to Citizenship)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="permanent_district" name="permanent_district"
                                placeholder="District" value="{{ old('permanent_district') }}">
                            <input type="text" class="form-control" id="permanent_municipality"
                                name="permanent_municipality" placeholder="Municipality/VDC"
                                value="{{ old('permanent_municipality') }}">
                            <input type="text" class="form-control" id="permanent_ward_no" name="permanent_ward_no"
                                placeholder="Ward No." value="{{ old('permanent_ward_no') }}">
                            <input type="text" class="form-control" id="permanent_tole" name="permanent_tole"
                                placeholder="Tole" value="{{ old('permanent_tole') }}">
                        </div>
                        <span class="text-danger error-message" id="error-permanent_district"></span>
                        <span class="text-danger error-message" id="error-permanent_municipality"></span>
                        <span class="text-danger error-message" id="error-permanent_ward_no"></span>
                        <span class="text-danger error-message" id="error-permanent_tole"></span>
                    </div>

                    <div class="form-group">
                        <label for="federal_province">Permanent Address (According to Federalism)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="federal_province" name="federal_province"
                                placeholder="Province" value="{{ old('federal_province') }}">
                            <input type="text" class="form-control" id="federal_district" name="federal_district"
                                placeholder="District" value="{{ old('federal_district') }}">
                            <input type="text" class="form-control" id="federal_municipality"
                                name="federal_municipality" placeholder="Municipality/Ga.Pa"
                                value="{{ old('federal_municipality') }}">
                        </div>
                        <span class="text-danger error-message" id="error-federal_province"></span>
                        <span class="text-danger error-message" id="error-federal_district"></span>
                        <span class="text-danger error-message" id="error-federal_municipality"></span>

                        <div class="input-group mt-2">
                            <input type="text" class="form-control" id="federal_ward_no" name="federal_ward_no"
                                placeholder="Ward No." value="{{ old('federal_ward_no') }}">
                            <input type="text" class="form-control" id="federal_tole" name="federal_tole"
                                placeholder="Tole" value="{{ old('federal_tole') }}">
                            <input type="text" class="form-control" id="federal_house_no" name="federal_house_no"
                                placeholder="House No." value="{{ old('federal_house_no') }}">
                        </div>
                        <span class="text-danger error-message" id="error-federal_ward_no"></span>
                        <span class="text-danger error-message" id="error-federal_tole"></span>
                        <span class="text-danger error-message" id="error-federal_house_no"></span>
                    </div>

                    <div class="form-group">
                        <label for="temporary_province">b) Temporary Address (According to Federalism)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="temporary_province" name="temporary_province"
                                placeholder="Province" value="{{ old('temporary_province') }}">
                            <input type="text" class="form-control" id="temporary_district" name="temporary_district"
                                placeholder="District" value="{{ old('temporary_district') }}">
                            <input type="text" class="form-control" id="temporary_municipality"
                                name="temporary_municipality" placeholder="Municipality/Ga.Pa"
                                value="{{ old('temporary_municipality') }}">
                            <span class="text-danger error-message" id="error-temporary_province"></span>
                            <span class="text-danger error-message" id="error-temporary_district"></span>
                            <span class="text-danger error-message" id="error-temporary_municipality"></span>
                        </div>
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" id="temporary_ward_no" name="temporary_ward_no"
                                placeholder="Ward No." value="{{ old('temporary_ward_no') }}">
                            <input type="text" class="form-control" id="temporary_tole" name="temporary_tole"
                                placeholder="Tole" value="{{ old('temporary_tole') }}">
                            <input type="text" class="form-control" id="temporary_house_no" name="temporary_house_no"
                                placeholder="House No." value="{{ old('temporary_house_no') }}">
                            <span class="text-danger error-message" id="error-temporary_ward_no"></span>
                            <span class="text-danger error-message" id="error-temporary_tole"></span>
                            <span class="text-danger error-message" id="error-temporary_house_no"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>c) Other</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Address" value="{{ old('email') }}">
                                    </div>
                                    <span class="text-danger error-message" id="error-email"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile No.:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-mobile"></i></span>
                                        </div>
                                        <input type="tel" class="form-control" id="mobile" name="mobile"
                                            placeholder="Mobile Number" value="{{ old('mobile') }}">
                                    </div>
                                    <span class="text-danger error-message" id="error-mobile"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                {{-- Details of family. --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">4. Details of Family</legend>
                    <div class="form-group">
                        <label for="father_name">a) Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name"
                            placeholder="Father's Name" value="{{ old('father_name') }}">
                        <span class="text-danger error-message" id="error-father_name"></span>
                    </div>
                    <div class="form-group">
                        <label for="grandfather_name">b) Grandfather / Father-in-law</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="relation_type" id="grandfather"
                                value="grandfather" {{ old('relation_type') == 'grandfather' ? 'checked' : '' }}>
                            <label class="form-check-label" for="grandfather">
                                Grandfather
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="relation_type" id="father_in_law"
                                value="father_in_law" {{ old('relation_type') == 'father_in_law' ? 'checked' : '' }}>
                            <label class="form-check-label" for="father_in_law">
                                Father-in-law
                            </label>
                        </div>
                        <span class="text-danger error-message" id="error-relation_type"></span>

                        <input type="text" class="form-control mt-2" id="grandfather_name" name="grandfather_name"
                            placeholder="Grandfather / Father-in-law's Name" value="{{ old('grandfather_name') }}">
                        <span class="text-danger error-message" id="error-grandfather_name"></span>
                    </div>

                    <div class="form-group">
                        <label for="spouse_name">c) Husband / Wife</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spouse_relation" id="husband"
                                value="husband" {{ old('spouse_relation') == 'husband' ? 'checked' : '' }}>
                            <label class="form-check-label" for="husband">
                                Husband
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="spouse_relation" id="wife"
                                value="wife" {{ old('spouse_relation') == 'wife' ? 'checked' : '' }}>
                            <label class="form-check-label" for="wife">
                                Wife
                            </label>
                        </div>

                        <span class="text-danger error-message" id="error-spouse_relation"></span>

                        <input type="text" class="form-control mt-2" id="spouse_name" name="spouse_name"
                            placeholder="Husband / Wife's Name" value="{{ old('spouse_name') }}">
                        <span class="text-danger error-message" id="error-spouse_name"></span>
                    </div>

                </fieldset>

                <!-- Payment Details Section -->
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">5. Payment Details</legend>
                    <!-- Payment Method Radio Buttons -->
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash"
                                value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }}>
                            <label class="form-check-label" for="cash">Cash</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="cheque"
                                value="cheque" {{ old('payment_method') == 'cheque' ? 'checked' : '' }}>
                            <label class="form-check-label" for="cheque">Cheque</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_deposit"
                                value="bankDeposit" {{ old('payment_method') == 'bankDeposit' ? 'checked' : '' }}>
                            <label class="form-check-label" for="bank_deposit">Bank Deposit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="ips"
                                value="ips" {{ old('payment_method') == 'ips' ? 'checked' : '' }}>
                            <label class="form-check-label" for="ips">IPS</label>
                        </div>
                    </div>
                    <span class="text-danger error-message" id="error-payment_method"></span>

                    <div class="form-group">
                        <label for="voucher">Upload voucher <small class="text-muted">(Max size: 2MB)</small></label>
                        <input type="file" class="form-control" id="voucher" name="voucher">
                        <span class="text-danger error-message" id="error-voucher"></span>
                    </div>
                </fieldset>

                {{-- Pan. --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">6. PAN</legend>
                    <div class="form-group">
                        <label for="pan">PAN No.</label>
                        <input type="text" class="form-control" id="pan" name="pan" placeholder="PAN No."
                            value="{{ old('pan') }}">
                    </div>
                    <span class="text-danger error-message" id="error-pan"></span>
                </fieldset>

                {{-- Education --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">7. Education</legend>
                    <div class="form-group">
                        <label for="education_level">Educational Level</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="education_level" name="education_level"
                                placeholder="Educational Qualification" value="{{ old('education_level') }}">
                            <input type="text" class="form-control" id="degree" name="degree"
                                placeholder="Degree" value="{{ old('degree') }}">
                        </div>
                        <span class="text-danger error-message" id="error-education_level"></span>
                        <span class="text-danger error-message" id="error-degree"></span>
                    </div>
                </fieldset>

                {{-- Profession --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">8. Profession</legend>
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="profession" name="profession"
                                placeholder="Profession" value="{{ old('profession') }}">
                            <input type="text" class="form-control" id="organization" name="organization"
                                placeholder="Organization" value="{{ old('organization') }}">
                            <input type="text" class="form-control" id="organization_address"
                                name="organization_address" placeholder="Organization Address"
                                value="{{ old('organization_address') }}">
                        </div>
                        <span class="text-danger error-message" id="error-profession"></span>
                        <span class="text-danger error-message" id="error-organization"></span>
                        <span class="text-danger error-message" id="error-organization_address"></span>
                    </div>
                </fieldset>

                {{-- Investment Details --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">9. Investment Details</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="share">Shares</label>
                                <input type="text" class="form-control" id="share" name="share"
                                    placeholder="Shares" value="{{ old('share') }}">
                            </div>
                            <span class="text-danger error-message" id="error-share"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="investment_amount">Investment Amount</label>
                                <input type="text" class="form-control" id="investment_amount"
                                    name="investment_amount" placeholder="Amount"
                                    value="{{ old('investment_amount') }}">
                            </div>
                            <span class="text-danger error-message" id="error-investment_amount"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount_in_words">Amount in Words</label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words"
                                    placeholder="Amount in Words" value="{{ old('amount_in_words') }}">
                            </div>
                            <span class="text-danger error-message" id="error-amount_in_words"></span>
                        </div>
                    </div>
                </fieldset>

                <!-- Declaration and Submit -->
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">10. Self-Declaration</legend>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="accept_terms" name="accept_terms"
                                {{ old('accept_terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="accept_terms">
                                I, the applicant, hereby declare that all the information mentioned here is true and
                                accurate.
                                I understand that my investment is subject to the rules and regulations of Rastriya Krishi
                                Company Nepal Ltd.,
                                and I agree to abide by all the terms and conditions set forth by the company.
                                Furthermore, I declare that the amount invested is from a legitimate source.
                            </label>
                        </div>
                        <span class="text-danger error-message" id="error-accept_terms"></span>
                    </div>
                    <div class="form-group">
                        <label for="signature">Signature <small class="text-muted">(Max size:
                                2MB)</small></label>
                        <input type="file" class="form-control" id="signature" name="signature">
                        <span class="text-danger error-message" id="error-signature"></span>
                    </div>
                </fieldset>
            </div>

            <!-- Submit Button -->
            <div class="container mt-4">
                <button type="submit" class="btn btn-primary submit-btn">Submit Form</button>
            </div>
        </div>
    </form>

    {{-- footer --}}
    <div class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>राष्ट्रिय कृषि कम्पनी नेपाल लि.</h5>
                    <p>हामी नेपालको कृषि क्षेत्रको विकासमा समर्पित छौं।</p>
                </div>
                <div class="col-md-4">
                    <h5>सम्पर्क</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> काठमाडौं, नेपाल<br>
                        <i class="fas fa-phone"></i> +977-1-5970017<br>
                        <i class="fas fa-envelope"></i> info@rastriyakrishi.com.np
                    </p>
                </div>
                <div class="col-md-4">
                    <h5>उपयोगी लिंकहरू</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">गोपनीयता नीति</a></li>
                        <li><a href="#">सेवाका सर्तहरू</a></li>
                        <li><a href="#">रोजगारी</a></li>
                        <li><a href="#">सहायता केन्द्र</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <small>&copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> राष्ट्रिय कृषि कम्पनी नेपाल लि. सर्वाधिकार सुरक्षित।
                </small>
            </div>
        </div>

    </div>

    <script>
        // Toggle parent details when the minor checkbox is checked
        document.getElementById('is_minor').addEventListener('change', function() {
            var parentDetails = document.getElementById('parent-details');
            if (this.checked) {
                parentDetails.style.display = 'block';
            } else {
                parentDetails.style.display = 'none';
            }
        });
        // Show parent details if the minor checkbox is pre-checked (for validation errors)
        window.onload = function() {
            if (document.getElementById('is_minor').checked) {
                document.getElementById('parent-details').style.display = 'block';
            }
        };

        // toggle form fields based on registration type selection
        document.addEventListener("DOMContentLoaded", function() {
            const formContainer = document.getElementById("form-container");
            const newFormFields = document.getElementById("new-form-fields");
            const existingRadio = document.getElementById("existing_registration");
            const newRadio = document.getElementById("new_registration");
            const existingFields = document.getElementById("existing-fields");
            const registeredNumberInput = document.getElementById("registration_number");

            formContainer.style.display = "none";
            existingFields.style.display = "none";

            function toggleFormVisibility() {
                formContainer.style.display = "block";
                existingFields.style.display = "none";
                if (existingRadio.checked) {
                    newFormFields.style.display = "none";
                    existingFields.style.display = "block";
                    registeredNumberInput.required = true;
                } else {
                    newFormFields.style.display = "block";
                    existingFields.style.display = "none";
                    registeredNumberInput.required = false;
                }
            }

            // Show the form only when a registration type is selected
            existingRadio.addEventListener("change", toggleFormVisibility);
            newRadio.addEventListener("change", toggleFormVisibility);

            const form = document.getElementById('registration-form');
            const responseMessage = document.getElementById('responseMessage');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content // CSRF token
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(error => {
                                throw error;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        responseMessage.innerHTML = '<p class="alert alert-success">' + data.message +
                            '</p>';
                        form.reset();
                        form.scrollIntoView({
                            behavior: 'smooth'
                        });
                        formContainer.style.display = "none";
                        // location.reload();
                    })
                    .catch(error => {
                        // Clear previous error messages
                        document.querySelectorAll('.error-message').forEach(el => el.innerHTML = '');

                        if (error.errors) {
                            let firstErrorKey = null; // To store the first error key for scrolling

                            for (const [key, messages] of Object.entries(error.errors)) {
                                const errorContainer = document.getElementById(`error-${key}`);
                                if (errorContainer) {
                                    errorContainer.innerHTML = messages[0];
                                    if (!firstErrorKey) firstErrorKey = key;
                                }
                            }

                            // Scroll to the first error message if there are any errors
                            if (firstErrorKey) {
                                const firstErrorContainer = document.getElementById(
                                    `error-${firstErrorKey}`);
                                if (firstErrorContainer) {
                                    firstErrorContainer.scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                }
                            }
                        } else {
                            responseMessage.innerHTML =
                                '<p class="alert alert-danger">An error occurred. Please try again.</p>';
                        }
                    });
            });
        });
    </script>
@endsection
