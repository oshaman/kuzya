<?php
/**
 * Created by PhpStorm.
 * User: Chepur
 * Date: 14.05.2018
 * Time: 15:28
 */

namespace App\Models;


trait SlugableTrait
{
    /**
     * @return \Closure
     */
    protected static function checkSlug(): \Closure
    {
        return function ($model) {
            if (!$model->slug) {
                $model->slug = str_slug($model->name);
            }
            $i = 1;
            $slug = $model->slug;

            while ($df = static::where('slug', $slug)->where('id', '<>', $model->id)->count()) {
                $slug = $model->slug.'-'.$i++;
            }
            $model->slug = $slug;

            return true;
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(self::checkSlug());
        static::updating(self::checkSlug());
    }
}