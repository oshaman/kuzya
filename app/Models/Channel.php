<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use LocalizeTrait, StatusTrait;

    protected $localized = [
        'name',
    ];

    protected $fillable = [
        'image',
        'priority',
        'partition_id'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
