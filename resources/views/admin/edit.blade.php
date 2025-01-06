@extends('layout.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
            </div>

            <div class="col-md-8 text-right pt-1">
                <a href="{{ route('admin.dashboard') }}" style="color:#F57921;">
                    <i class="bi bi-arrow-left-circle"></i> Go Back
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="container">
        <!-- Form Start -->
        <form action="{{ route('admin.update', ['id' => $user->id, 'type' => request('type')]) }}" method="POST"
            enctype="multipart/form-data" id="edit_registration_form">
            @csrf
            @method('PUT')
            <div id="new-form-fields">
                <!-- Personal Information Section -->
                <div class="container mt-4">
                    <fieldset class="border p-4 mb-4">
                        <legend class="w-auto">1. Personal Information</legend>
                        <div class="row">
                            <div class="col-md-9">

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="full_name">1. Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name"
                                        value="{{ $user->full_name }}" placeholder="Enter full name">
                                    @if ($errors->has('full_name'))
                                        <div class="text-danger">{{ $errors->first('full_name') }}</div>
                                    @endif
                                </div>

                                <!-- Date of Birth -->
                                <div class="form-group">
                                    <label for="dob_bs">2. Date of Birth</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="dob_bs" name="dob_bs"
                                            value="{{ $user->dob_bs }}" placeholder="Enter date of birth (BS)">
                                        <input type="text" class="form-control" id="dob_ad" name="dob_ad"
                                            value="{{ $user->dob_ad }}" placeholder="Enter date of birth (AD)">
                                    </div>
                                    @if ($errors->has('dob_bs'))
                                        <div class="text-danger">{{ $errors->first('dob_bs') }}</div>
                                    @endif
                                    @if ($errors->has('dob_ad'))
                                        <div class="text-danger">{{ $errors->first('dob_ad') }}</div>
                                    @endif
                                </div>

                                <!-- Citizenship Details -->
                                <div class="form-group">
                                    <label for="citizenship_no">3. Citizenship Details</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="citizenship_no" name="citizenship_no"
                                            value="{{ $user->citizenship_no }}" placeholder="Enter citizenship number">
                                        <input type="text" class="form-control" id="citizenship_issued"
                                            name="citizenship_issued" value="{{ $user->citizenship_issued }}"
                                            placeholder="Enter issued district">
                                        <input type="text" class="form-control" id="citizenship_district"
                                            name="citizenship_district" value="{{ $user->citizenship_district }}"
                                            placeholder="Enter citizenship district">
                                    </div>
                                    @if ($errors->has('citizenship_no'))
                                        <div class="text-danger">{{ $errors->first('citizenship_no') }}</div>
                                    @endif
                                    @if ($errors->has('citizenship_issued'))
                                        <div class="text-danger">{{ $errors->first('citizenship_issued') }}</div>
                                    @endif
                                    @if ($errors->has('citizenship_district'))
                                        <div class="text-danger">{{ $errors->first('citizenship_district') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="national_id_no">4. National ID Number</label>
                                    <input type="text" class="form-control" id="national_id_no" name="national_id_no"
                                        value="{{ $user->national_id_no }}" placeholder="Enter national ID number">
                                    @if ($errors->has('national_id_no'))
                                        <div class="text-danger">{{ $errors->first('national_id_no') }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- File Uploads -->
                            <div class="col-md-3">
                                <!-- Photo -->
                                @if ($user->photo)
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo"
                                                style="max-width: 100%;">
                                        </div>

                                        <a href="{{ route('download.file', ['field' => 'photo', 'file_path' => $user->photo]) }}"
                                            class="btn btn-sm btn-warning">
                                            Download Photo
                                        </a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="photo">Photo <small class="text-muted">(Max size:
                                                2MB)</small></label>
                                        <input type="file" class="form-control-file" id="photo" name="photo"
                                            value="{{ old('photo') }}">
                                        @if ($errors->has('photo'))
                                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Citizenship -->
                                @if ($user->citizenship)
                                    <div class="form-group">
                                        <label for="citizenship">Citizenship</label>
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $user->citizenship) }}" alt="Citizenship"
                                                style="max-width: 100%;">
                                        </div>

                                        <a href="{{ route('download.file', ['field' => 'citizenship', 'file_path' => $user->citizenship]) }}"
                                            class="btn btn-sm btn-warning">
                                            Download Citizenship
                                        </a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="citizenship">Citizenship <small class="text-muted">(Max size:
                                                2MB)</small></label>
                                        <input type="file" class="form-control-file" id="citizenship"
                                            name="citizenship" value="{{ old('citizenship') }}">
                                        @if ($errors->has('citizenship'))
                                            <div class="text-danger">{{ $errors->first('citizenship') }}</div>
                                        @endif
                                    </div>
                                @endif

                                {{-- National Id --}}
                                @if ($user->national_id)
                                    <div class="form-group">
                                        <label for="national_id">National ID</label>
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $user->national_id) }}" alt="National ID"
                                                style="max-width: 100%;">
                                        </div>
                                        <a href="{{ route('download.file', ['field' => 'national_id', 'file_path' => $user->national_id]) }}"
                                            class="btn btn-sm btn-warning">
                                            Download National ID
                                        </a>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="national_id">National ID <small class="text-muted">(Max size:
                                                2MB)</small></label>
                                        <input type="file" class="form-control-file" id="national_id"
                                            name="national_id" value="{{ old('national_id') }}">
                                        @if ($errors->has('national_id'))
                                            <div class="text-danger">{{ $errors->first('national_id') }}</div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                </div>


                {{-- Minor section --}}
                <div class="container mt-4">
                    <fieldset class="border p-4 mb-4">
                        <legend class="w-auto">2. Are you a minor?</legend>

                        <div class="form-group">
                            <!-- Hidden input to send '0' when checkbox is unchecked -->
                            <input type="hidden" name="is_minor" value="0">

                            <!-- Checkbox input for 'is_minor' -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_minor" name="is_minor"
                                    value="1" {{ $user->is_minor ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_minor">Yes, I am a minor</label>
                            </div>

                            @if ($errors->has('is_minor'))
                                <div class="text-danger">{{ $errors->first('is_minor') }}</div>
                            @endif
                        </div>

                        <!-- Parent Details (Visible if is_minor is true) -->
                        <div id="parent-details" style="{{ $user->is_minor ? '' : 'display: none;' }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="minor_father_name">Guardian's Name</label>
                                        <input type="text" class="form-control" id="minor_father_name"
                                            name="minor_father_name" placeholder="Guardian's Name"
                                            value="{{ $user->minor_father_name ?? '' }}">
                                        @if ($errors->has('minor_father_name'))
                                            <div class="text-danger">{{ $errors->first('minor_father_name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_district">Guardian's Address (According to Citizenship of
                                            Guardian)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="parent_district"
                                                name="parent_district" placeholder="District"
                                                value="{{ $user->parent_district ?? '' }}">
                                            <input type="text" class="form-control" id="parent_municipality"
                                                name="parent_municipality" placeholder="Municipality/VDC"
                                                value="{{ $user->parent_municipality ?? '' }}">
                                            <input type="text" class="form-control" id="parent_ward_no"
                                                name="parent_ward_no" placeholder="Ward No."
                                                value="{{ $user->parent_ward_no ?? '' }}">
                                            <input type="text" class="form-control" id="parent_tole"
                                                name="parent_tole" placeholder="Tole"
                                                value="{{ $user->parent_tole ?? '' }}">
                                        </div>
                                        @if ($errors->has('parent_district'))
                                            <div class="text-danger">{{ $errors->first('parent_district') }}</div>
                                        @endif
                                        @if ($errors->has('parent_municipality'))
                                            <div class="text-danger">{{ $errors->first('parent_municipality') }}</div>
                                        @endif
                                        @if ($errors->has('parent_ward_no'))
                                            <div class="text-danger">{{ $errors->first('parent_ward_no') }}</div>
                                        @endif
                                        @if ($errors->has('parent_tole'))
                                            <div class="text-danger">{{ $errors->first('parent_tole') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="minor_guardian_relation">Guardian's Relation</label>
                                        <input type="text" class="form-control" id="minor_guardian_relation"
                                            name="minor_guardian_relation" placeholder="Guardian's Relation"
                                            value="{{ $user->minor_guardian_relation ?? '' }}">
                                        @if ($errors->has('minor_guardian_relation'))
                                            <div class="text-danger">{{ $errors->first('minor_guardian_relation') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="minor_guardian_bank_name">Guardian's Bank Name</label>
                                        <input type="text" class="form-control" id="minor_guardian_bank_name"
                                            name="minor_guardian_bank_name" placeholder="Guardian's Bank Name"
                                            value="{{ $user->minor_guardian_bank_name ?? '' }}">
                                        @if ($errors->has('minor_guardian_bank_name'))
                                            <div class="text-danger">{{ $errors->first('minor_guardian_bank_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="minor_guardian_bank_account_number">Guardian's Bank Account
                                            Number</label>
                                        <input type="text" class="form-control"
                                            id="minor_guardian_bank_account_number"
                                            name="minor_guardian_bank_account_number"
                                            placeholder="Guardian's Bank Account Number"
                                            value="{{ $user->minor_guardian_bank_account_number ?? '' }}">
                                        @if ($errors->has('minor_guardian_bank_account_number'))
                                            <div class="text-danger">
                                                {{ $errors->first('minor_guardian_bank_account_number') }}</div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        @if ($user->parent_citizenship)
                                            <div class="col-md-6 form-group">
                                                <label for="m_parent_citizenship">Guardian's Citizenship Photo</label>
                                                <div class="mb-3">
                                                    <img src="{{ asset('storage/' . $user->parent_citizenship) }}"
                                                        alt="Parent Citizenship" style="max-width: 70%;">
                                                </div>
                                                <a href="{{ route('download.file', ['field' => 'parent_citizenship', 'file_path' => $user->parent_citizenship]) }}"
                                                    class="btn btn-sm btn-warning">
                                                    Download Parent Citizenship
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-md-6 form-group">
                                                <label for="parent_citizenship">Guardian's Citizenship Photo <small
                                                        class="text-muted">(Max size: 2MB)</small></label>
                                                <input type="file" class="form-control" id="parent_citizenship"
                                                    name="parent_citizenship" value="{{ old('parent_citizenship') }}">
                                                @if ($errors->has('parent_citizenship'))
                                                    <div class="text-danger">{{ $errors->first('parent_citizenship') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        @if ($user->birth_certificate)
                                            <div class="col-md-6 form-group">
                                                <label for="birth_certificate">Birth Certificate</label>
                                                <div class="mb-3">
                                                    <img src="{{ asset('storage/' . $user->birth_certificate) }}"
                                                        alt="Birth Certificate" style="max-width: 70%;">
                                                </div>
                                                <a href="{{ route('download.file', ['field' => 'birth_certificate', 'file_path' => $user->birth_certificate]) }}"
                                                    class="btn btn-sm btn-warning">
                                                    Download Birth Certificate
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-md-6 form-group">
                                                <label for="birth_certificate">Birth Certificate <small
                                                        class="text-muted">(Max size: 2MB)</small></label>
                                                <input type="file" class="form-control" id="birth_certificate"
                                                    name="birth_certificate" value="{{ old('birth_certificate') }}">
                                                @if ($errors->has('birth_certificate'))
                                                    <div class="text-danger">{{ $errors->first('birth_certificate') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>

            <!-- Address Details Section -->
            <div id="existing-form-fields" class="container mt-4">
                <div id="existing-fields" class="form-group">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number"
                        value="{{ $user->registration_number }}" placeholder="Enter your registration number">
                    @if ($errors->has('registration_number'))
                        <div class="text-danger">{{ $errors->first('registration_number') }}</div>
                    @endif
                </div>

                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">3. Address Details</legend>

                    <!-- Permanent Address -->
                    <div class="form-group">
                        <label for="permanent_district">A) Permanent Address (According to Citizenship)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="permanent_district" name="permanent_district"
                                value="{{ $user->permanent_district }}" placeholder="Enter permanent district">
                            <input type="text" class="form-control" id="permanent_municipality"
                                name="permanent_municipality"
                                value="Municipality/VDC: {{ $user->permanent_municipality }}"
                                placeholder="Enter municipality/VDC">
                            <input type="text" class="form-control" id="permanent_ward_no" name="permanent_ward_no"
                                value="{{ $user->permanent_ward_no }}" placeholder="Enter permanent ward number">
                            <input type="text" class="form-control" id="permanent_tole" name="permanent_tole"
                                value="{{ $user->permanent_tole }}" placeholder="Enter permanent tole">
                        </div>
                        @if ($errors->has('permanent_district'))
                            <div class="text-danger">{{ $errors->first('permanent_district') }}</div>
                        @endif
                        @if ($errors->has('permanent_municipality'))
                            <div class="text-danger">{{ $errors->first('permanent_municipality') }}</div>
                        @endif
                        @if ($errors->has('permanent_ward_no'))
                            <div class="text-danger">{{ $errors->first('permanent_ward_no') }}</div>
                        @endif
                        @if ($errors->has('permanent_tole'))
                            <div class="text-danger">{{ $errors->first('permanent_tole') }}</div>
                        @endif
                    </div>

                    <!-- Federal Address -->
                    <div class="form-group">
                        <label for="federal_province">Permanent Address (According to Federalism)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="federal_province" name="federal_province"
                                value="{{ $user->federal_province }}" placeholder="Enter federal province">
                            <input type="text" class="form-control" id="federal_district" name="federal_district"
                                value="{{ $user->federal_district }}" placeholder="Enter federal district">
                            <input type="text" class="form-control" id="federal_municipality"
                                name="federal_municipality" value="{{ $user->federal_municipality }}"
                                placeholder="Enter federal municipality">
                        </div>
                        @if ($errors->has('federal_province'))
                            <div class="text-danger">{{ $errors->first('federal_province') }}</div>
                        @endif
                        @if ($errors->has('federal_district'))
                            <div class="text-danger">{{ $errors->first('federal_district') }}</div>
                        @endif
                        @if ($errors->has('federal_municipality'))
                            <div class="text-danger">{{ $errors->first('federal_municipality') }}</div>
                        @endif
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" id="federal_ward_no" name="federal_ward_no"
                                value="{{ $user->federal_ward_no }}" placeholder="Enter federal ward number">
                            <input type="text" class="form-control" id="federal_tole" name="federal_tole"
                                value="{{ $user->federal_tole }}" placeholder="Enter federal tole">
                            <input type="text" class="form-control" id="federal_house_no" name="federal_house_no"
                                value="{{ $user->federal_house_no }}" placeholder="Enter federal house number">
                        </div>
                        @if ($errors->has('federal_ward_no'))
                            <div class="text-danger">{{ $errors->first('federal_ward_no') }}</div>
                        @endif
                        @if ($errors->has('federal_tole'))
                            <div class="text-danger">{{ $errors->first('federal_tole') }}</div>
                        @endif
                        @if ($errors->has('federal_house_no'))
                            <div class="text-danger">{{ $errors->first('federal_house_no') }}</div>
                        @endif
                    </div>

                    <!-- Temporary Address -->
                    <div class="form-group">
                        <label for="temporary_province">B) Temporary Address (According to Federalism)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="temporary_province" name="temporary_province"
                                value="{{ $user->temporary_province }}" placeholder="Enter temporary province">
                            <input type="text" class="form-control" id="temporary_district" name="temporary_district"
                                value="{{ $user->temporary_district }}" placeholder="Enter temporary district">
                            <input type="text" class="form-control" id="temporary_municipality"
                                name="temporary_municipality" value="{{ $user->temporary_municipality }}"
                                placeholder="Enter temporary municipality">
                        </div>
                        @if ($errors->has('temporary_province'))
                            <div class="text-danger">{{ $errors->first('temporary_province') }}</div>
                        @endif
                        @if ($errors->has('temporary_district'))
                            <div class="text-danger">{{ $errors->first('temporary_district') }}</div>
                        @endif
                        @if ($errors->has('temporary_municipality'))
                            <div class="text-danger">{{ $errors->first('temporary_municipality') }}</div>
                        @endif
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" id="temporary_ward_no" name="temporary_ward_no"
                                value="{{ $user->temporary_ward_no }}" placeholder="Enter temporary ward number">
                            <input type="text" class="form-control" id="temporary_tole" name="temporary_tole"
                                value="{{ $user->temporary_tole }}" placeholder="Enter temporary tole">
                            <input type="text" class="form-control" id="temporary_house_no" name="temporary_house_no"
                                value="{{ $user->temporary_house_no }}" placeholder="Enter temporary house number">
                        </div>
                        @if ($errors->has('temporary_ward_no'))
                            <div class="text-danger">{{ $errors->first('temporary_ward_no') }}</div>
                        @endif
                        @if ($errors->has('temporary_tole'))
                            <div class="text-danger">{{ $errors->first('temporary_tole') }}</div>
                        @endif
                        @if ($errors->has('temporary_house_no'))
                            <div class="text-danger">{{ $errors->first('temporary_house_no') }}</div>
                        @endif
                    </div>

                    <!-- Email and Mobile -->
                    <div class="form-group">
                        <label>C) Others</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" placeholder="Enter your email">
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile No.:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input type="tel" class="form-control" id="mobile" name="mobile"
                                            value="{{ $user->mobile }}" placeholder="Enter your mobile number">
                                    </div>
                                    @if ($errors->has('mobile'))
                                        <div class="text-danger">{{ $errors->first('mobile') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">4. Details of Family</legend>

                    <!-- Father's Name -->
                    <div class="form-group">
                        <label for="father_name">A) Father's Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name"
                            value="{{ old('father_name', $user->father_name) }}" placeholder="Enter Father's Name">
                        @if ($errors->has('father_name'))
                            <div class="text-danger">{{ $errors->first('father_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="grandfather_name">B) Grandfather/Father-in-law</label>
                        <br>
                        <!-- Display Relation Type as Radio Buttons -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="grandfather" name="relation_type"
                                value="grandfather"
                                {{ old('relation_type', $user->relation_type) == 'grandfather' ? 'checked' : '' }}>
                            <label class="form-check-label" for="grandfather">Grandfather</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="father_in_law" name="relation_type"
                                value="father_in_law"
                                {{ old('relation_type', $user->relation_type) == 'father_in_law' ? 'checked' : '' }}>
                            <label class="form-check-label" for="father_in_law">Father-in-law</label>
                        </div>

                        @if ($errors->has('relation_type'))
                            <div class="text-danger">{{ $errors->first('relation_type') }}</div>
                        @endif
                        <!-- Display Grandfather Name -->
                        <input type="text" class="form-control mt-2" id="grandfather_name" name="grandfather_name"
                            value="{{ old('grandfather_name', $user->grandfather_name) }}"
                            placeholder="Enter Grandfather's Name">

                        @if ($errors->has('grandfather_name'))
                            <div class="text-danger">{{ $errors->first('grandfather_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="spouse_name">C) Husband/Wife</label>
                        <br>
                        <!-- Display Spouse Relation as Radio Buttons -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="husband" name="spouse_relation"
                                value="husband"
                                {{ old('spouse_relation', $user->spouse_relation) == 'husband' ? 'checked' : '' }}>
                            <label class="form-check-label" for="husband">Husband</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="wife" name="spouse_relation"
                                value="wife"
                                {{ old('spouse_relation', $user->spouse_relation) == 'wife' ? 'checked' : '' }}>
                            <label class="form-check-label" for="wife">Wife</label>
                        </div>
                        @if ($errors->has('spouse_relation'))
                            <div class="text-danger">{{ $errors->first('spouse_relation') }}</div>
                        @endif
                        <!-- Display Spouse Name -->
                        <input type="text" class="form-control mt-2" id="spouse_name" name="spouse_name"
                            value="{{ old('spouse_name', $user->spouse_name) }}" placeholder="Enter Spouse's Name">
                        @if ($errors->has('spouse_name'))
                            <div class="text-danger">{{ $errors->first('spouse_name') }}</div>
                        @endif
                    </div>

                </fieldset>
            </div>


            <!-- Payment Details Section -->
            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">5. Payment Details</legend>

                    <!-- Payment Method Radio Buttons -->
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash"
                                value="cash"
                                {{ old('payment_method', $user->payment_method) == 'cash' ? 'checked' : '' }}>
                            <label class="form-check-label" for="cash">Cash</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="cheque"
                                value="cheque"
                                {{ old('payment_method', $user->payment_method) == 'cheque' ? 'checked' : '' }}>
                            <label class="form-check-label" for="cheque">Cheque</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="bank_deposit"
                                value="bankDeposit"
                                {{ old('payment_method', $user->payment_method) == 'bankDeposit' ? 'checked' : '' }}>
                            <label class="form-check-label" for="bank_deposit">Bank Deposit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_method" id="ips"
                                value="ips"
                                {{ old('payment_method', $user->payment_method) == 'ips' ? 'checked' : '' }}>
                            <label class="form-check-label" for="ips">IPS</label>
                        </div>
                        @error('payment_method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (old('payment_method', $user->payment_method) == 'cheque')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                        placeholder="Enter bank name" value="{{ old('bank_name', $user->bank_name) }}">
                                    @error('bank_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bank_branch" class="form-label">Bank Branch</label>
                                    <input type="text" class="form-control" id="bank_branch" name="bank_branch"
                                        placeholder="Enter bank branch"
                                        value="{{ old('bank_branch', $user->bank_branch) }}">
                                    @error('bank_branch')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                    <input type="text" class="form-control" id="account_holder_name"
                                        name="account_holder_name" placeholder="Enter account holder name"
                                        value="{{ old('account_holder_name', $user->account_holder_name) }}">
                                    @error('account_holder_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number"
                                        placeholder="Enter account number"
                                        value="{{ old('account_number', $user->account_number) }}">
                                    @error('account_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Cheque Number -->
                            <div class="col-md-6 mb-3">
                                <label for="cheque_no" class="form-label">Cheque Number</label>
                                <input type="text" class="form-control" id="cheque_no" name="cheque_no"
                                    placeholder="Enter cheque number" value="{{ old('cheque_no', $user->cheque_no) }}">
                                @error('cheque_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Cheque Amount -->
                            <div class="col-md-6 mb-3">
                                <label for="cheque_amount" class="form-label">Cheque Amount</label>
                                <input type="text" class="form-control" id="cheque_amount" name="cheque_amount"
                                    placeholder="Enter cheque amount"
                                    value="{{ old('cheque_amount', $user->cheque_amount) }}">
                                @error('cheque_amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @if (old('payment_method', $user->payment_method) !== 'cash')
                        <div class="form-group">
                            <label for="voucher">Voucher</label>
                            <div class="col-md-3">
                                @if ($user->voucher)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $user->voucher) }}" alt="voucher"
                                            style="max-width: 100%;">
                                    </div>
                                    <a href="{{ route('download.file', ['field' => 'voucher', 'file_path' => $user->voucher]) }}"
                                        class="btn btn-sm btn-warning">
                                        Download Voucher
                                    </a>
                                @else
                                    <div class="form-group" id="voucher-container">
                                        <label for="voucher">Upload voucher <small class="text-muted">(Max size:
                                                2MB)</small></label>
                                        <input type="file" class="form-control" id="voucher" name="voucher">
                                        @if ($errors->has('voucher'))
                                            <div class="text-danger">{{ $errors->first('voucher') }}</div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </fieldset>
            </div>

            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">6. PAN</legend>
                    <div class="form-group">
                        <label for="pan">PAN No.</label>
                        <input type="text" class="form-control" id="pan" name="pan" placeholder="PAN No."
                            value="{{ $user->pan }}">
                        @if ($errors->has('pan'))
                            <div class="text-danger">{{ $errors->first('pan') }}</div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">7. Education</legend>
                    <div class="form-group">
                        <label for="education_level">Educational Level</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="education_level" name="education_level"
                                placeholder="Educational Qualification" value="{{ $user->education_level }}">
                            <input type="text" class="form-control" id="degree" name="degree"
                                placeholder="Degree" value="{{ $user->degree }}">
                        </div>
                        @if ($errors->has('education_level'))
                            <div class="text-danger">{{ $errors->first('education_level') }}</div>
                        @endif
                        @if ($errors->has('degree'))
                            <div class="text-danger">{{ $errors->first('degree') }}</div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">8. Profession</legend>
                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="profession" name="profession"
                                placeholder="Profession" value="{{ $user->profession }}">
                            <input type="text" class="form-control" id="organization" name="organization"
                                placeholder="Organization" value="{{ $user->organization }}">
                            <input type="text" class="form-control" id="organization_address"
                                name="organization_address" placeholder="Organization Address"
                                value="{{ $user->organization_address }}">
                        </div>
                        @if ($errors->has('profession'))
                            <div class="text-danger">{{ $errors->first('profession') }}</div>
                        @endif
                        @if ($errors->has('organization'))
                            <div class="text-danger">{{ $errors->first('organization') }}</div>
                        @endif
                        @if ($errors->has('organization_address'))
                            <div class="text-danger">{{ $errors->first('organization_address') }}</div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">9. Investment Details</legend>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold">A. Investment Commitment</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="share">Shares</label>
                                <input type="text" class="form-control" id="share" name="share"
                                    placeholder="Shares"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->share : '' }}">
                                @if ($errors->has('share'))
                                    <div class="text-danger">{{ $errors->first('share') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="investment_amount">Investment Amount</label>
                                <input type="text" class="form-control" id="investment_amount"
                                    name="investment_amount" placeholder="Amount"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->investment_amount : '' }}">
                                @if ($errors->has('investment_amount'))
                                    <div class="text-danger">{{ $errors->first('investment_amount') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="amount_in_words">Amount in Words</label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words"
                                    placeholder="Amount in Words"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->amount_in_words : '' }}">
                                @if ($errors->has('amount_in_words'))
                                    <div class="text-danger">{{ $errors->first('amount_in_words') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row" id="display_initial_investment">
                        <div class="col-12">
                            <label class="form-label fw-bold">B. Initial Investment</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="share_initial">Shares</label>
                                <input type="number" class="form-control" id="share_initial" name="share_initial"
                                    placeholder="Number of Shares"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->share_initial : '' }}">
                                @if ($errors->has('share_initial'))
                                    <div class="text-danger">{{ $errors->first('share_initial') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="investment_amount_initial">Investment Amount</label>
                                <input type="text" class="form-control" id="investment_amount_initial"
                                    name="investment_amount_initial" placeholder="Amount"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->investment_amount_initial : '' }}">
                                @if ($errors->has('investment_amount_initial'))
                                    <div class="text-danger">{{ $errors->first('investment_amount_initial') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount_in_words_initial">Amount in Words</label>
                                <input type="text" class="form-control" id="amount_in_words_initial"
                                    name="amount_in_words_initial" placeholder="Amount in Words"
                                    value="{{ $user->investmentDetailsById ? $user->investmentDetailsById->amount_in_words_initial : '' }}">
                                @if ($errors->has('amount_in_words_initial'))
                                    <div class="text-danger">{{ $errors->first('amount_in_words_initial') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>



            {{-- Terms and conditions --}}
            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">10. Terms & Conditions</legend>
                    <div class="form-group">
                        <label class="form-check-label" for="terms_conditions">
                            <strong>लगानीकर्ताको लागि कम्पनीको नियम र शर्तहरू</strong><br />
                            <ul>
                                <li>१. शेयर/अग्रिम लगानी (सापटी) राष्ट्रिय कृषि कम्पनी नेपाल लि. का नियम र शर्तहरूको अधीनमा
                                    रहनेछ।
                                </li>
                                <li>२. कम्पनीले कुनै पनि आवेदन स्वीकृत वा अस्वीकृत गर्ने अधिकार राख्दछ।</li>
                                <li>३. लगानीकर्ताले कम्पनीद्वारा तोकिएका तथा समय समयमा तोकिने सबै नियम र शर्तहरू पालना गर्न
                                    सहमत
                                    हुनुपर्दछ।</li>
                                <li>४. कम्पनीद्धारा तोकिएको अवस्था बाहेक लगानी रकम अव्यवहार्य र अस्थानान्तरणीय हुनेछ।</li>
                                <li>५. लगानीकर्ताले साँचो र यथार्थ जानकारी उपलब्ध गराउनु पर्दछ। कुनै पनि गलत जानकारीको
                                    परिणामस्वरूप
                                    आवेदन अस्वीकृत हुन सक्छ र लगानीकर्ता स्वंयले परिस्थितिको सामाना गर्नुपर्नेछ।</li>
                                <li>६. लगानीकर्ताले कम्पनीको प्रबन्ध पत्र तथा नियमावली तथा कम्पनी सम्बन्धि कानून तथा प्रचलित
                                    कानून
                                    पालना गर्नुपर्नेछ।</li>
                                <li>७. लगानीकर्ताले रकम जम्मा गर्दा वा कारोबार गर्दा कम्पनीको बैंक खाता मार्फत मात्रै
                                    गर्नुपर्दछ।
                                    कुनै पनि व्यक्तिको नाममा रकम वा चेक दिन वा जारी गर्नु हुदैन।</li>
                            </ul>
                            <p><strong>नोट:</strong> कम्पनीको सम्बन्धमा कुनै जानकारी चाहियमा वा सम्पर्क गर्नुपरेमा कम्पनीको
                                ईमेल
                                साथै कम्पनीको आधिकारीक व्यक्ति वा मोबाईल नम्बर <strong>015922911</strong> मा सम्पर्क गर्न
                                सक्नुहुनेछ।</p>
                        </label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="terms_conditions"
                                name="terms_conditions" {{ $user->terms_conditions ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms_conditions">
                                I Agree
                            </label>
                        </div>
                        @if ($errors->has('terms_conditions'))
                            <div class="text-danger">{{ $errors->first('terms_conditions') }}</div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <!-- Declaration and Submit -->
            <div class="container mt-4">
                <fieldset class="border p-4 mb-4">
                    <legend class="w-auto">11. Self-Declaration</legend>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="accept_terms" name="accept_terms"
                                {{ $user->accept_terms ? 'checked' : '' }}>
                            <label class="form-check-label" for="accept_terms">
                                I, the applicant, hereby declare that all the information mentioned here is true and
                                accurate.
                                I understand that my investment is subject to the rules and regulations of Rastriya Krishi
                                Company Nepal Ltd.,
                                and I agree to abide by all the terms and conditions set forth by the company.
                                Furthermore, I declare that the amount invested is from a legitimate source.
                            </label>
                            @if ($errors->has('accept_terms'))
                                <div class="text-danger">{{ $errors->first('accept_terms') }}</div>
                            @endif
                        </div>
                    </div>
                    @if ($user->signature)
                        <label for="signature">Signature</label>
                        <div class="form-group">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $user->signature) }}" alt="Signature"
                                        style="max-width: 100%;">
                                </div>
                                <a href="{{ route('download.file', ['field' => 'signature', 'file_path' => $user->signature]) }}"
                                    class="btn btn-sm btn-warning">
                                    Download Signature
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="signature">Signature <small class="text-muted">(Max size:
                                    2MB)</small></label>
                            <input type="file" class="form-control" id="signature" name="signature">
                            @if ($errors->has('signature'))
                                <div class="text-danger">{{ $errors->first('signature') }}</div>
                            @endif
                        </div>
                    @endif
                </fieldset>

                <fieldset class="border p-4 mb-4">
                    <div class="form-group">
                        <label for="referred_by">Referred By</label>
                        <input type="text" name="referred_by" id="referred_by" class="form-control"
                            value="{{ $user->referred_by }}">
                        @if ($errors->has('referred_by'))
                            <div class="text-danger">{{ $errors->first('referred_by') }}</div>
                        @endif
                    </div>
                </fieldset>
            </div>

            <div class="container mt-4 mb-4">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
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

        const type = @json($type);
        // toggle form fields based on registration type selection
        document.addEventListener("DOMContentLoaded", function() {
            const newFormFields = document.getElementById("new-form-fields");
            const existingFields = document.getElementById("existing-fields");

            function toggleFormVisibility() {
                if (type === 'existing') {
                    newFormFields.style.display = "none";
                    existingFields.style.display = "block";
                } else {
                    newFormFields.style.display = "block";
                    existingFields.style.display = "none";
                }
            }
            toggleFormVisibility();
        });
    </script>
@endsection
