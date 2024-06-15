<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'start_time',
        'end_time',
        'token',
        'content',
        'status',
        'user_id',
        'url',
    ];
}
