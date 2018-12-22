<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class News
 *
 * @package App\Models
 * @property string name
 * @property string content
 *
 * @property string image
 * @property string slug
 * @property Carbon date_in
 * @property bool   active
 * @property int   priority
 */
class Article extends Model
{
//    protected $table='newss';
    use LocalizeTrait;
    use SlugableTrait;
    use StatusTrait;

    protected $localized
        = [
            'name',
            'content',
        ];

    protected $fillable
        = [
            'image',
            'date_in',
            'priority',
            'slug',
        ];

    protected $dates
        = [
            'date_in',
        ];
    protected $casts
        = [
            'active' => 'boolean',
        ];
}
