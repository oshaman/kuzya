<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @package App\Models
 * @property int id
 * @property string question
 * @property string answer
 * @property int category_id
 * @property array all_category
 * @property  boolean active
 * @property int priority
 * @property Category category
 */
class Question extends Model
{
    use LocalizeTrait, StatusTrait;

    protected $localized = [
        'question',
        'answer',
    ];
    protected $fillable = [
        'category_id',
        'priority',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

}
