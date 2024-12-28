<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentDetail extends Model
{
    use HasFactory;

    protected $table = 'investment_details';

    protected $fillable = [
        'new_user_id',
        'registration_number',
        'share',
        'investment_amount',
        'amount_in_words',
        'share_initial',
        'investment_amount_initial',
        'amount_in_words_initial',
    ];

    // Define the relationship with the NewUser model
    public function newUserByRegNumber()
    {
        return $this->belongsTo(NewUser::class, 'registration_number', 'registration_number');
    }

    public function newUserById()
    {
        return $this->belongsTo(NewUser::class, 'new_user_id', 'id');
    }
}
