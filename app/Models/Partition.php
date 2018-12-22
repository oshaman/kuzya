<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Partition
 *
 * @package App\Models
 * @property string     name
 * @property string     slug
 * @property boolean action
 * @property int priority
 * @property
 */
class Partition extends Model
{
    use LocalizeTrait, SlugableTrait, StatusTrait;

    protected $localized = [
            'name',
        ];

    protected $fillable = [
            'slug',
            'priority',
        ];

    public function setSlugAttribute()
    {
        if (!$this->slug || !request()->has('slug')) {
            $this->attributes['slug'] = str_slug($this->name_ru);
        }
    }

    public function channels()
    {
        return $this->hasMany(Channel::class)->where('active', 1)->orderBy('priority');
    }

    public static function getAllowed()
    {
        return self::where('active', 1)->with('channels')->orderBy('priority')->get();
    }

}
