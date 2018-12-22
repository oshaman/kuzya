<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Technical
 *
 * @package App\Models
 * @property string title
 * @property string content
 *
 * @property string image
 * @property string background
 * @property bool   active
 */


class Technical extends Model
{
    use LocalizeTrait;
    use SlugableTrait;
    protected $localized
        = [
            'title',
            'content',
        ];

    protected $fillable
        = [
            'image',
            'background',
//            'slug',
        ];

    protected $casts
        = [
            'active' => 'boolean',
        ];

    public function setDraft()
    {
        $this->active = 0;
        $this->save();
    }

    public function setActive()
    {
        $this->active = 1;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null) {
            return $this->setDraft();
        }

        return $this->setActive();
    }

    public static function getEngineering()
    {
        return static::where('slug', 'engineering')->where('active', 1)->with('lang')->first();
    }

    public static function getTech()
    {
        return static::where('slug', 'technical')->where('active', 1)->with('lang')->first();
    }

    public function getImage()
    {
        return $this->image ?? '';
    }

    public function getBg()
    {
        return $this->background ?? '';
    }
}
