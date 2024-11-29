<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentDetail extends Model
{
    use HasFactory;

    protected $table = 'investment_details';

    protected $fillable = [
        'registration_number',
        'share',
        'investment_amount',
        'amount_in_words',
    ];

    // Define the relationship with the NewUser model
    public function newUser()
    {
        return $this->belongsTo(NewUser::class, 'registration_number', 'registration_number');
    }
}
