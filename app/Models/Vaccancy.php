<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccancy extends Model
{
    use HasFactory;

    protected $fillable=['designation','type','salary_range','skills','description','status'];
}
