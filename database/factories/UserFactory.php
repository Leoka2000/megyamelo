<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'university',
        'photo',
        'degree',
        'area',
        'description',
        'cv',
        'accept',
        'referral',
        'linkedin',
        'other_links',
        'is_published',
        'heart_count',
    ];

    protected $casts = [
        'id' => 'string',
        'accept' => 'boolean',
        'is_published' => 'boolean',
        'heart_count' => 'integer',
    ];
}