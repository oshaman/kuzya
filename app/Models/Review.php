<?php

namespace App\Models;

use App\Http\Middleware\Locale;
use App\Lang;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @package App\Models
 * @property int     id
 * @property string  name
 * @property string  description
 * @property string  image
 * @property boolean is_visible
 * @property User    user
 * @property int     user_id
 * @property Carbon  review_data
 */
class Review extends Model
{
    protected $localized
        = [
            'name',
            'description',
        ];

    protected $fillable
        = [
            'image',
            'is_visible',
            'user_id',
            'review_data',
        ];
    protected $dates = ['review_data'];
    protected $casts = ['is_visible' => 'boolean'];

    use LocalizeTrait;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

}
