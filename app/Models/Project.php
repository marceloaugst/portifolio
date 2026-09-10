<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'link',
        'description',
        'screenshots',
        'order',
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    protected $attributes = [
        'screenshots' => '[]',
    ];
}
