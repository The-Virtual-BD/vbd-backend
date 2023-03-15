<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'short_description',
        'client_name',
        'client_type',
        'client_origin',
        'image_1',
        'image_2',
        'image_3',
        'video',
        'description',
        'service_id'
    ];


    //12-jan-Y
}
