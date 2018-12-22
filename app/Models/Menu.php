<?php

namespace App\Models;

use App\Http\Middleware\Locale;
use App\Lang;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 *
 * @package App\Models
 * @property int         id
 * @property string      slug
 * @property string      link
 * @property string      name
 * @property string      menu_link
 * @property int         static_id
 * @property int         priority
 * @property boolean     approved
 * @property StaticPages page
 * @property int         parent_id
 * @property Menu        parent
 * @property Menu[]      childs
 * @property Lang        lang
 */
class Menu extends Model
{
    protected $localized
        = [
            'name',
        ];

    protected $fillable
        = [
            'slug',
            'menu_link',
            'static_id',
            'parent_id',
            'priority',
            ];

    use SlugableTrait;
    use LocalizeTrait;

    public function getLinkAttribute()
    {
        return $this->menu_link ?? ($this->page ? route($this->page->slug) : '');
    }

    public function parent()
    {

        return $this->hasOne(self::class, 'parent_id', 'id');
    }

    public function page()
    {
        return $this->hasOne(StaticPages::class, 'id', 'static_id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function setDraft()
    {
        $this->approved = 0;
        $this->save();
    }

    public function setApproved()
    {
        $this->approved = 1;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null) {
            return $this->setDraft();
        }

        return $this->setApproved();
    }

    public static function getActive()
    {
        $all = self::where('approved', 1)->with('childs')->orderBy('priority')->get();
        return $all;
    }

    public function getUrl()
    {
        return $this->link ?? route($this->slug);
    }

}
