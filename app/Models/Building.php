<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Building
 * @package App\Models
 * @property string name
 * @property Point[] points
 */
class Building extends Model
{
    protected $localized
        = [
            'name',
        ];

    use LocalizeTrait;

    protected $fillable = ['points'];

    protected $casts = [
        'points' => 'array',
    ];


}

