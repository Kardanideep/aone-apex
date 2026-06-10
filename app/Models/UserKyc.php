<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'document_number',
        'front_image',
        'back_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
