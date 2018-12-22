<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class StaticPages
 *
 * @package App\Models
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string name
 * @property string content
 * @property string slug
 * @property string template
 * @property string attr
 * @property string attr_ru
 * @property string attr_uk
 * @property bool published
 * @property Seo seo
 * @property int seo_id_ru
 * @property int seo_id_uk
 * @property Menu menu
 */
class StaticPages extends Model
{
    use /*SlugableTrait,*/
        SeoTrait;
    use LocalizeTrait;
    protected $fillable
        = [
            'published',
            'slug',
            'template',
        ];

    protected $localized
        = [
            'name',
            'content',
            'attr',
            'footertext',
        ];
    protected $casts
        = [
            'published' => 'bool',
        ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'static_id');
    }

    public function getBuildings()
    {
        Cache::forget('buildings');
        $buildings = Cache::remember('buildings', 90, function () {
            return Building::query()->get()->map(
                function ($mod) {
                    /** @var Building $mod */
                    $mod->load('lang');
                    $point = $mod->points[0];
                    $build = [
                        round($point['pointX'], 6),
                        round($point['pointY'], 6),
                        $mod->name
                    ];
                    return $build;
                });

        });
        return $buildings->toJson();
    }
}
