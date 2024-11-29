@extends('layout.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <img src="https://app.rastriyakrishi.com.np/assets/img/Logo_long.jpg" class="w-100" />
            </div>

            <div class="col-md-8 text-right pt-1">
                <a href="javascript:void(0);" onclick="window.history.back();" style="color:#F57921;">
                    <i class="bi bi-arrow-left-circle"></i> Go Back
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                                    value="{{ $user->full_name }}" readonly>
                            </div>

                            <!-- Date of Birth -->
                            <div class="form-group">
                                <label for="dob_bs">2. Date of Birth</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="dob_bs" name="dob_bs"
                                        value="{{ $user->dob_bs }} (BS)" readonly>
                                    <input type="text" class="form-control" id="dob_ad" name="dob_ad"
                                        value="{{ $user->dob_ad }} (AD)" readonly>
                                </div>
                            </div>

                            <!-- Citizenship Details -->
                            <div class="form-group">
                                <label for="citizenship_no">3. Citizenship Details</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="citizenship_no" name="citizenship_no"
                                        value="No.: {{ $user->citizenship_no }}" readonly>
                                    <input type="text" class="form-control" id="citizenship_issued"
                                        name="citizenship_issued" value="Issued Date: {{ $user->citizenship_issued }}"
                                        readonly>
                                    <input type="text" class="form-control" id="citizenship_district"
                                        value="District: {{ $user->citizenship_district }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="national_id_no">4. National ID Number</label>
                                <input type="text" class="form-control" id="national_id_no" name="national_id_no"
                                    value="{{ $user->national_id_no }}" readonly>
                            </div>
                        </div>

                        <!-- File Uploads -->
                        <div class="col-md-3">
                            <!-- Photo -->
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                @if ($user->photo)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo"
                                            style="max-width: 100%;">
                                    </div>

                                    <a href="{{ route('download.file', ['field' => 'photo', 'file_path' => $user->photo]) }}"
                                        class="btn btn-sm btn-warning">
                                        Download Photo
                                    </a>
                                @else
                                    <p class="text-muted">
                                        <small>No photo uploaded</small>
                                    </p>
                                @endif
                            </div>

                            <!-- Citizenship -->
                            <div class="form-group">
                                <label for="citizenship">Citizenship</label>
                                @if ($user->citizenship)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $user->citizenship) }}" alt="Citizenship"
                                            style="max-width: 100%;">
                                    </div>

                                    <a href="{{ route('download.file', ['field' => 'citizenship', 'file_path' => $user->citizenship]) }}"
                                        class="btn btn-sm btn-warning">
                                        Download Citizenship
                                    </a>
                                @else
                                    <p class="text-muted">
                                        <small>No citizenship file uploaded</small>
                                    </p>
                                @endif
                            </div>

                            {{-- National Id --}}
                            <div class="form-group">
                                <label for="national_id">National ID</label>
                                @if ($user->national_id)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $user->national_id) }}" alt="National ID"
                                            style="max-width: 100%;">
                                    </div>
                                    <a href="{{ route('download.file', ['field' => 'national_id', 'file_path' => $user->national_id]) }}"
                                        class="btn btn-sm btn-warning">
                                        Download National ID
                                    </a>
                                @else
                                    <p class="text-muted">
                                        <small>No National ID file uploaded</small>
                                    </p>
                                @endif
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

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_minor" name="is_minor"
                                {{ $user->is_minor ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="is_minor">Yes, I am a minor</label>
                        </div>
                    </div>

                    <!-- Parent Details (Visible if is_minor is true) -->
                    <div id="parent-details" style="{{ $user->is_minor ? '' : 'display: none;' }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="minor_father_name">Guardian's Name</label>
                                    <input type="text" class="form-control" id="minor_father_name"
                                        name="minor_father_name" placeholder="Guardian's Name"
                                        value="{{ $user->minor_father_name ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="parent_district"> Guardian's Address (According to Citizenship of
                                        Guardian)</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="parent_district"
                                            name="parent_district" placeholder="District"
                                            value="{{ $user->parent_district ?? '' }}" readonly>
                                        <input type="text" class="form-control" id="parent_municipality"
                                            name="parent_municipality" placeholder="Municipality/VDC"
                                            value="{{ $user->parent_municipality ?? '' }}" readonly>
                                        <input type="text" class="form-control" id="parent_ward_no"
                                            name="parent_ward_no" placeholder="Ward No."
                                            value="{{ $user->parent_ward_no ?? '' }}" readonly>
                                        <input type="text" class="form-control" id="parent_tole" name="parent_tole"
                                            placeholder="Tole" value="{{ $user->parent_tole ?? '' }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="minor_guardian_relation">Guardian's Relation</label>
                                    <input type="text" class="form-control" id="minor_guardian_relation"
                                        name="minor_guardian_relation" placeholder="Guardian's Relation"
                                        value="{{ $user->minor_guardian_relation ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="minor_guardian_bank_name">Guardian's Bank Name</label>
                                    <input type="text" class="form-control" id="minor_guardian_bank_name"
                                        name="minor_guardian_bank_name" placeholder="Guardian's Bank Name"
                                        value="{{ $user->minor_guardian_bank_name ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="minor_guardian_bank_account_number">Guardian's Bank Account Number</label>
                                    <input type="text" class="form-control" id="minor_guardian_bank_account_number"
                                        name="minor_guardian_bank_account_number"
                                        placeholder="Guardian's Bank Account Number"
                                        value="{{ $user->minor_guardian_bank_account_number ?? '' }}" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="m_parent_citizenship">Guardian's Citizenship Photo</label>
                                        @if ($user->parent_citizenship)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $user->parent_citizenship) }}"
                                                    alt="Parent Citizenship" style="max-width: 70%;">
                                            </div>
                                            <a href="{{ route('download.file', ['field' => 'parent_citizenship', 'file_path' => $user->parent_citizenship]) }}"
                                                class="btn btn-sm btn-warning">
                                                Download Parent Citizenship
                                            </a>
                                        @else
                                            <p class="text-muted">
                                                <small>No guardian citizenship file uploaded</small>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="birth_certificate">Birth Certificate</label>
                                        @if ($user->birth_certificate)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $user->birth_certificate) }}"
                                                    alt="Birth Certificate" style="max-width: 70%;">
                                            </div>
                                            <a href="{{ route('download.file', ['field' => 'birth_certificate', 'file_path' => $user->birth_certificate]) }}"
                                                class="btn btn-sm btn-warning">
                                                Download Birth Certificate
                                            </a>
                                        @else
                                            <p class="text-muted">
                                                <small>No birth certificate file uploaded</small>
                                            </p>
                                        @endif
                                    </div>
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
                    value="{{ $user->registration_number }}" readonly>
            </div>
            <fieldset class="border p-4 mb-4">
                <legend class="w-auto">3. Address Details</legend>

                <!-- Permanent Address -->
                <div class="form-group">
                    <label for="permanent_district">A) Permanent Address (According to Citizenship)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="permanent_district" name="permanent_district"
                            value="District: {{ $user->permanent_district }}" readonly>
                        <input type="text" class="form-control" id="permanent_municipality"
                            name="permanent_municipality" value="Municipality/VDC: {{ $user->permanent_municipality }}"
                            readonly>
                        <input type="text" class="form-control" id="permanent_ward_no" name="permanent_ward_no"
                            value="Ward No.: {{ $user->permanent_ward_no }}" readonly>
                        <input type="text" class="form-control" id="permanent_tole" name="permanent_tole"
                            value="Tole: {{ $user->permanent_tole }}" readonly>
                    </div>
                </div>

                <!-- Federal Address -->
                <div class="form-group">
                    <label for="federal_province">Permanent Address (According to Federalism)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="federal_province" name="federal_province"
                            value="Province: {{ $user->federal_province }}" readonly>
                        <input type="text" class="form-control" id="federal_district" name="federal_district"
                            value="District: {{ $user->federal_district }}" readonly>
                        <input type="text" class="form-control" id="federal_municipality" name="federal_municipality"
                            value="Municipality: {{ $user->federal_municipality }}" readonly>
                    </div>
                    <div class="input-group mt-2">
                        <input type="text" class="form-control" id="federal_ward_no" name="federal_ward_no"
                            value="Ward No.: {{ $user->federal_ward_no }}" readonly>
                        <input type="text" class="form-control" id="federal_tole" name="federal_tole"
                            value="Tole: {{ $user->federal_tole }}" readonly>
                        <input type="text" class="form-control" id="federal_house_no" name="federal_house_no"
                            value="House No.: {{ $user->federal_house_no }}" readonly>
                    </div>
                </div>

                <!-- Temporary Address -->
                <div class="form-group">
                    <label for="temporary_province">B) Temporary Address (According to Federalism)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="temporary_province" name="temporary_province"
                            value="Province: {{ $user->temporary_province }}" readonly>
                        <input type="text" class="form-control" id="temporary_district" name="temporary_district"
                            value="District: {{ $user->temporary_district }}" readonly>
                        <input type="text" class="form-control" id="temporary_municipality"
                            name="temporary_municipality" value="Municipality: {{ $user->temporary_municipality }}"
                            readonly>
                    </div>
                    <div class="input-group mt-2">
                        <input type="text" class="form-control" id="temporary_ward_no" name="temporary_ward_no"
                            value="Ward No.: {{ $user->temporary_ward_no }}" readonly>
                        <input type="text" class="form-control" id="temporary_tole" name="temporary_tole"
                            value="Tole: {{ $user->temporary_tole }}" readonly>
                        <input type="text" class="form-control" id="temporary_house_no" name="temporary_house_no"
                            value="House No.: {{ $user->temporary_house_no }}" readonly>
                    </div>
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
                                        value="{{ $user->email }}" readonly>
                                </div>
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
                                        value="{{ $user->mobile }}" readonly>
                                </div>
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
                        value="{{ $user->father_name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="grandfather_name">B) Grandfather/Father-in-law</label>
                    <br>
                    <!-- Display Relation Type as Radio Buttons -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="grandfather" name="relation_type"
                            value="grandfather" {{ $user->relation_type == 'grandfather' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="grandfather">Grandfather</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="father_in_law" name="relation_type"
                            value="father_in_law" {{ $user->relation_type == 'father_in_law' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="father_in_law">Father-in-law</label>
                    </div>

                    <!-- Display Grandfather Name -->
                    <input type="text" class="form-control mt-2" id="grandfather_name"
                        value="{{ $user->grandfather_name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="spouse_name">C) Husband/Wife</label>
                    <br>
                    <!-- Display Spouse Relation as Radio Buttons -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="husband" name="spouse_relation"
                            value="husband" {{ $user->spouse_relation == 'husband' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="husband">Husband</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="wife" name="spouse_relation"
                            value="wife" {{ $user->spouse_relation == 'wife' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="wife">Wife</label>
                    </div>

                    <!-- Display Spouse Name -->
                    <input type="text" class="form-control mt-2" id="spouse_name" value="{{ $user->spouse_name }}"
                        readonly>
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
                            value="cash" {{ $user->payment_method == 'cash' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="cash">Cash</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_method" id="cheque"
                            value="cheque" {{ $user->payment_method == 'cheque' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="cheque">Cheque</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_method" id="bank_deposit"
                            value="bankDeposit" {{ $user->payment_method == 'bankDeposit' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="bank_deposit">Bank Deposit</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_method" id="ips"
                            value="ips" {{ $user->payment_method == 'ips' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="ips">IPS</label>
                    </div>
                </div>
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
                            <p class="text-muted">
                                <small>No voucher file uploaded</small>
                            </p>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="container mt-4">
            <fieldset class="border p-4 mb-4">
                <legend class="w-auto">6. PAN</legend>
                <div class="form-group">
                    <label for="pan">PAN No.</label>
                    <input type="text" class="form-control" id="pan" name="pan" placeholder="PAN No."
                        value="{{ $user->pan }}" readonly>
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
                            placeholder="Educational Qualification" value="{{ $user->education_level }}" readonly>
                        <input type="text" class="form-control" id="degree" name="degree" placeholder="Degree"
                            value="{{ $user->degree }}" readonly>
                    </div>
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
                            placeholder="Profession" value="{{ $user->profession }}" readonly>
                        <input type="text" class="form-control" id="organization" name="organization"
                            placeholder="Organization" value="{{ $user->organization }}" readonly>
                        <input type="text" class="form-control" id="organization_address" name="organization_address"
                            placeholder="Organization Address" value="{{ $user->organization_address }}" readonly>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="container mt-4">
            <fieldset class="border p-4 mb-4">
                <legend class="w-auto">9. Investment Details</legend>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="share">Shares</label>
                            <input type="text" class="form-control" id="share" name="share"
                                placeholder="Shares" value="{{ $user->share }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="investment_amount">Investment Amount</label>
                            <input type="text" class="form-control" id="investment_amount" name="investment_amount"
                                placeholder="Amount" value="{{ $user->investment_amount }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount_in_words">Amount in Words</label>
                            <input type="text" class="form-control" id="amount_in_words" name="amount_in_words"
                                placeholder="Amount in Words" value="{{ $user->amount_in_words }}" readonly>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <!-- Declaration and Submit -->
        <div class="container mt-4">
            <fieldset class="border p-4 mb-4">
                <legend class="w-auto">10. Self-Declaration</legend>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="accept_terms" name="accept_terms"
                            {{ $user->accept_terms ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="accept_terms">
                            I, the applicant, hereby declare that all the information mentioned here is true and
                            accurate.
                            I understand that my investment is subject to the rules and regulations of Rastriya Krishi
                            Company Nepal Ltd.,
                            and I agree to abide by all the terms and conditions set forth by the company.
                            Furthermore, I declare that the amount invested is from a legitimate source.
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="signature">Signature</label>
                    <div class="col-md-3">
                        @if ($user->signature)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $user->signature) }}" alt="Signature"
                                    style="max-width: 100%;">
                            </div>
                            <a href="{{ route('download.file', ['field' => 'signature', 'file_path' => $user->signature]) }}"
                                class="btn btn-sm btn-warning">
                                Download Signature
                            </a>
                        @else
                            <p class="text-muted">
                                <small>No signature file uploaded</small>
                            </p>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="container mt-4 mb-4">
            @if ($user->status === 'pending')
                <form action="{{ route('admin.approve', ['id' => $user->id, 'type' => request('type')]) }}"
                    method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>

                <form action="{{ route('admin.disapprove', ['id' => $user->id]) }}"
                    method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Disapprove</button>
                </form>
            @else
                <span class="badge {{ $user->status === 'approved' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($user->status) }}
                </span>
            @endif
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
