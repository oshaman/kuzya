<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @package App\Models
 * @property string     name
 * @property string     slug
 * @property Question[] questions
 */
class Category extends Model
{
    use LocalizeTrait, SlugableTrait;

    protected $localized
        = [
            'name',
        ];

    protected $fillable
        = [
            'slug',
        ];

    public function setSlugAttribute()
    {
        if (!$this->slug || !request()->has('slug')) {
            $this->attributes['slug'] = str_slug($this->name_ru);
        }
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'category_id', 'id')->where('active', 1)->orderBy('priority');
    }

}
