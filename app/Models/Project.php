<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_name',
        'user_id',
        'service_id',
        'starting_date',
        'ending_date',
        'value',
        'value_paid',
        'value_payable',
        'documents',
        'cover',
        'description',
        'short_description',
        'status',
        'protfolio',
    ];
}
