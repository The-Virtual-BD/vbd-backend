<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'cv', 'vaccancy_id', 'expected_salary'];


    protected $with = ['vaccancy'];



    public function vaccancy()
    {
        return $this->belongsTo(Vaccancy::class);
    }
}
