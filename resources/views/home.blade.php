@extends('layout.main')
@section('content')
    @include('layout.navbar')
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
                                            <label for="birth_certificate">Birth Certificate <small
                                                    class="text-muted">(Max size: 2MB)</small></label>
                                            <input type="file" class="form-control" id="birth_certificate"
                                                name="birth_certificate" value="{{ old('birth_certificate') }}">
                                            <span class="text-danger error-message" id="error-birth_certificate"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            {{-- Registration Number --}}
            <div id="reg_number_field" class="container mt-4 form-group">
                <label for="registration_number">Registration Number:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="registration_number" name="registration_number"
                        placeholder="Enter registration number">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="search-registration">Search</button>
                    </div>
                </div>
                <span class="text-danger error-message" id="error-registration_number"></span>
            </div>
            <div id="existing-form-fields" class="container mt-4">
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
                    <div class="form-group" id="bank_details">
                        <div class="row">
                            <!-- Bank Name -->
                            <div class="col-md-6 mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name"
                                    placeholder="Enter bank name" value="{{ old('bank_name') }}">
                                <span class="text-danger error-message" id="error-bank_name"></span>
                            </div>
                            <!-- Bank Branch -->
                            <div class="col-md-6 mb-3">
                                <label for="bank_branch" class="form-label">Bank Branch</label>
                                <input type="text" class="form-control" id="bank_branch" name="bank_branch"
                                    placeholder="Enter bank branch" value="{{ old('bank_branch') }}">
                                <span class="text-danger error-message" id="error-bank_branch"></span>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Account Holder Name -->
                            <div class="col-md-6 mb-3">
                                <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                <input type="text" class="form-control" id="account_holder_name"
                                    name="account_holder_name" placeholder="Enter account holder name"
                                    value="{{ old('account_holder_name') }}">
                                <span class="text-danger error-message" id="error-account_holder_name"></span>
                            </div>
                            <!-- Account Number -->
                            <div class="col-md-6 mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number"
                                    placeholder="Enter account number" value="{{ old('account_number') }}">
                                <span class="text-danger error-message" id="error-account_number"></span>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Cheque Number -->
                            <div class="col-md-6 mb-3">
                                <label for="cheque_no" class="form-label">Cheque Number</label>
                                <input type="text" class="form-control" id="cheque_no"
                                    name="cheque_no" placeholder="Enter cheque number"
                                    value="{{ old('cheque_no') }}">
                                <span class="text-danger error-message" id="error-cheque_no"></span>
                            </div>
                            <!-- Cheque Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="cheque_amount" class="form-label">Cheque Amount</label>
                                <input type="text" class="form-control" id="cheque_amount" name="cheque_amount"
                                    placeholder="Enter cheque amount" value="{{ old('cheque_amount') }}">
                                <span class="text-danger error-message" id="error-cheque_amount"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="voucher-container">
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
                        <div class="col-12">
                            <label class="form-label fw-bold">A. Investment Commitment</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="share">Shares</label>
                                <input type="number" class="form-control" id="share" name="share"
                                    placeholder="Number of Shares" value="{{ old('share') }}" min="1">
                                <span class="text-danger error-message" id="error-share"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="investment_amount">Investment Amount</label>
                                <input type="text" class="form-control" id="investment_amount"
                                    name="investment_amount" placeholder="Amount" value="{{ old('investment_amount') }}"
                                    readonly>
                                <span class="text-danger error-message" id="error-investment_amount"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount_in_words">Amount in Words</label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words"
                                    placeholder="Amount in Words" value="{{ old('amount_in_words') }}" readonly>
                                <span class="text-danger error-message" id="error-amount_in_words"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="display_initial_investment" style="display: none;">
                        <div class="col-12">
                            <label class="form-label fw-bold">B. Initial Investment</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="share_initial">Shares</label>
                                <input type="number" class="form-control" id="share_initial" name="share_initial"
                                    placeholder="Number of Shares" value="{{ old('share_initial') }}" min="1">
                                <span class="text-danger error-message" id="error-share_initial"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="investment_amount_initial">Investment Amount</label>
                                <input type="text" class="form-control" id="investment_amount_initial"
                                    name="investment_amount_initial" placeholder="Amount" value="{{ old('investment_amount_initial') }}"
                                    readonly>
                                <span class="text-danger error-message" id="error-investment_amount_initial"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount_in_words_initial">Amount in Words</label>
                                <input type="text" class="form-control" id="amount_in_words_initial" name="amount_in_words_initial"
                                    placeholder="Amount in Words" value="{{ old('amount_in_words_initial') }}" readonly>
                                <span class="text-danger error-message" id="error-amount_in_words_initial"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="display_row" style="display: none;">
                        <div class="col-12">
                            <label class="form-label fw-bold">B. Initial Investment</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="share_display" id="share_label" class="form-label"
                                style="display: none;">Share:</label>
                            <div class="border p-2 rounded bg-light" id="share_display" style="display: none;"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="investment_amount_display" id="investment_amount_label" class="form-label"
                                style="display: none;">
                                Investment Amount:
                            </label>
                            <div class="border p-2 rounded bg-light" id="investment_amount_display"
                                style="display: none;"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="amount_in_words_display" id="amount_in_words_label" class="form-label"
                                style="display: none;">
                                Amount in Words:
                            </label>
                            <div class="border p-2 rounded bg-light" id="amount_in_words_display" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <!-- Hidden field for share rate -->
                    <input type="hidden" id="share_rate" value="{{ $shareRate ? $shareRate->rate : 0 }}" />
                </fieldset>

                {{-- Terms and conditions --}}
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">10. Terms & Conditions</legend>
                    <div class="form-group">
                        <label class="form-check-label" for="terms_conditions">
                            <strong>लगानीकर्ताको लागि कम्पनीको नियम र शर्तहरू</strong><br />
                            <ul>
                                <li>१. शेयर/अग्रिम लगानी (सापटी) राष्ट्रिय कृषि कम्पनी नेपाल लि. का नियम र शर्तहरूको अधीनमा
                                    रहनेछ।</li>
                                <li>२. कम्पनीले कुनै पनि आवेदन स्वीकृत वा अस्वीकृत गर्ने अधिकार राख्दछ।</li>
                                <li>३. लगानीकर्ताले कम्पनीद्वारा तोकिएका तथा समय समयमा तोकिने सबै नियम र शर्तहरू पालना गर्न
                                    सहमत हुनुपर्दछ।</li>
                                <li>४. कम्पनीद्धारा तोकिएको अवस्था बाहेक लगानी रकम अव्यवहार्य र अस्थानान्तरणीय हुनेछ।</li>
                                <li>५. लगानीकर्ताले साँचो र यथार्थ जानकारी उपलब्ध गराउनु पर्दछ। कुनै पनि गलत जानकारीको
                                    परिणामस्वरूप आवेदन अस्वीकृत हुन सक्छ र लगानीकर्ता स्वंयले परिस्थितिको सामाना
                                    गर्नुपर्नेछ।</li>
                                <li>६. लगानीकर्ताले कम्पनीको प्रबन्ध पत्र तथा नियमावली तथा कम्पनी सम्बन्धि कानून तथा प्रचलित
                                    कानून पालना गर्नुपर्नेछ।</li>
                                <li>७. लगानीकर्ताले रकम जम्मा गर्दा वा कारोबार गर्दा कम्पनीको बैंक खाता मार्फत मात्रै
                                    गर्नुपर्दछ। कुनै पनि व्यक्तिको नाममा रकम वा चेक दिन वा जारी गर्नु हुदैन।</li>
                            </ul>
                            <p><strong>नोट:</strong> कम्पनीको सम्बन्धमा कुनै जानकारी चाहियमा वा सम्पर्क गर्नुपरेमा कम्पनीको
                                ईमेल साथै कम्पनीको आधिकारीक व्यक्ति वा मोबाईल नम्बर <strong>015922911</strong> मा सम्पर्क
                                गर्न सक्नुहुनेछ।</p>
                        </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="terms_conditions"
                                name="terms_conditions" {{ old('terms_conditions') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms_conditions">
                                I Agree
                            </label>
                        </div>
                        <span class="text-danger error-message" id="error-terms_conditions"></span>
                    </div>
                </fieldset>

                <!-- Declaration and Submit -->
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">11. Self-Declaration</legend>
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

                <fieldset class="border p-4 mb-4">
                    <div class="form-group">
                        <label for="referred_by">Referred By</label>
                        <input type="text" name="referred_by" id="referred_by" class="form-control"
                            placeholder="Referred By">
                        <span class="text-danger error-message" id="error-referred_by"></span>
                    </div>
                </fieldset>
            </div>

            <!-- Submit Button -->
            <div class="container mt-4" id="submit_button">
                <button type="submit" class="btn btn-primary submit-btn">Submit Form</button>
            </div>
        </div>
    </form>

    @include('layout.footer')
    <script src="{{ asset('js/registration.js') }}"></script>
@endsection
