<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seo
 *
 * @package App
 * @property int    id
 * @property string seo_title
 * @property string seo_keywords
 * @property string seo_description
 * @property string seo_text
 * @property string og_title
 * @property string og_description
 * @property string og_image
 */
class Seo extends Model
{
    protected $fillable
        = [
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_text',
            'og_title',
            'og_description',
            'og_image',
        ];
}
