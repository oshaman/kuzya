<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock
 *
 * @package App\Models
 * @property string name
 * @property string content
 *
 * @property string image
 * @property string slug
 * @property Carbon date_in
 * @property bool   active
 */
class Stock extends Model
{
    use LocalizeTrait;
    use SlugableTrait;
    use StatusTrait;
    protected $localized = [
            'name',
            'content',
        ];

    protected $fillable = [
            'image',
            'date_in',
            'slug',
            'priority',
        ];

    protected $dates = [
            'date_in',
        ];
    protected $casts = [
            'active' => 'boolean',
        ];

}
