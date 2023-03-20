<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'quantity',
        'body',
        'status'
    ];

    protected $with = ['author'];


    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
