<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'otp_code',
        'otp_type',
        'expires_at',
        'status',
        'ip_address'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
