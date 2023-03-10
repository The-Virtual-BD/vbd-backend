<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'service_id', 'subject', 'description', 'attachment', 'schedule', 'status'
    ];



    protected $with = ['applicant', 'service'];



    public function applicant()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
    public function chats()
    {
        return $this->hasMany(SubChat::class);
    }
}
