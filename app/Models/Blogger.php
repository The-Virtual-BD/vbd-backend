<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'subject', 'expertise', 'description', 'status'
    ];
}
