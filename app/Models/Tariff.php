<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tariff
 *
 * @package App\Models
 * @property int id
 *
 * @property string name
 * @property string apartment
 * @property string house
 * @property array attr
 *
 * @property string image
 * @property int price
 * @property int village_price
 * @property boolean in_apartment
 * @property boolean active
 */
class Tariff extends Model
{
    protected $localized = [
        'name',
        'apartment',
        'house',
        'attr',
    ];
    protected $fillable = [
        'image',
        'price',
        'village_price',
        'in_apartment',
    ];
    protected $casts = [
        'in_apartment' => 'boolean',
        'active' => 'boolean',
    ];

    use LocalizeTrait, StatusTrait;
}
