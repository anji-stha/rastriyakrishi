<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate'
    ];
}
