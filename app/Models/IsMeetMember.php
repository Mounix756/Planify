<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsMeetMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'meet_id',
        'user_id',
        'token',
        'status',
    ];
}
