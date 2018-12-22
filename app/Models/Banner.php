<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 *
 * @package App\Models
 * @property int     id
 * @property string  image
 * @property string  link
 * @property boolean in_main
 */
class Banner extends Model
{
    protected $localized
        = [
            'image',
        ];

    use LocalizeTrait;

    protected $fillable
        = [
            'link',
            'in_main',
        ];

}
