<?php

namespace App\Models;

use App\Models\LocalizeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 13:06
 */

/**
 * Class Advantages
 *
 * @property int     id
 * @property string  name
 * @property string  image
 * @property string  image_dark
 * @property boolean in_main
 * @property boolean in_internet
 * @property boolean in_about
 */
class Advantages extends Model
{
    protected $localized
        = [
            'name',
        ];

    protected $fillable
        = [
            'image',
            'image_dark',
            'in_main',
            'in_internet',
            'in_about',
        ];

    use LocalizeTrait;
}


