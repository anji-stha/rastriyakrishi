<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExistingUser extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'share',
        'investment_amount',
        'amount_in_words',
        'status',
        'accept_terms',
        'voucher',
        'registration_number',
        'signature'
    ];

    // You can set default values for the status attribute
    protected $attributes = [
        'status' => 'pending',
    ];
}
