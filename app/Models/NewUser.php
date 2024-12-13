<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'dob_bs',
        'dob_ad',
        'citizenship_no',
        'citizenship_issued',
        'citizenship_district',
        'permanent_district',
        'permanent_municipality',
        'permanent_ward_no',
        'permanent_tole',
        'federal_province',
        'federal_district',
        'federal_municipality',
        'federal_ward_no',
        'federal_tole',
        'federal_house_no',
        'temporary_province',
        'temporary_district',
        'temporary_municipality',
        'temporary_ward_no',
        'temporary_tole',
        'temporary_house_no',
        'email',
        'mobile',
        'father_name',
        'grandfather_name',
        'spouse_name',
        'relation_type',
        'spouse_relation',
        'payment_method',
        'pan',
        'education_level',
        'degree',
        'profession',
        'organization',
        'organization_address',
        'citizenship',
        'signature',
        'status',
        'accept_terms',
        'photo',
        'voucher',
        'is_minor',
        'minor_father_name',
        'parent_district',
        'parent_municipality',
        'parent_ward_no',
        'parent_tole',
        'parent_citizenship',
        'minor_guardian_relation',
        'minor_guardian_bank_name',
        'minor_guardian_bank_account_number',
        'national_id_no',
        'national_id',
        'birth_certificate',
        'bank_name',
        'bank_branch',
        'account_holder_name',
        'account_number',
        'registration_number',
        'is_exist',
        'referred_by',
        'terms_conditions',
    ];

    // You can set default values for the status attribute
    protected $attributes = [
        'status' => 'pending',
    ];

    public function investmentDetails()
    {
        return $this->hasMany(InvestmentDetail::class, 'registration_number', 'registration_number');
    }

    public function investmentDetailsById()
    {
        return $this->hasOne(InvestmentDetail::class, 'new_user_id', 'id');
    }
}
