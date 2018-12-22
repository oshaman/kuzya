<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 20.06.2018
 * Time: 9:38
 */

namespace App\Models;


use App\Http\Middleware\Locale;
use App\Lang;

/**
 * Trait LocalizeTrait
 *
 * ==========================================================
 *  переключение языков
 * @foreach(\App\Http\Middleware\Locale::$languages as $lang)
 * <span class="{{$lang==\App\Http\Middleware\Locale::$mainLanguage}}" data-v="{{$lang}}">{{$lang}}</span>
 *
 * @endforeach
 * ==========================================================
 * для форм использовать <div class="localize">
 *                           <div data-lang="{{$lang}}">
 *                              <input type="text"
 *                              name="{{$field_name.'_'.$lang}}"
 *                              id="{{$field_name}}"
 *                              value="{{$model->{$field_name.'_'.$lang}??'' }}">
 *                           </div>
 *                        </div>
 *                        <div data-lang="{{$lang}}">
 *                                <textarea name="{{$field}}"
 *                                      id="{{$field_name}}" class="textarea">{{$model->{$field}??''}}</textarea>
 *
 *                        </div>
 * ==========================================================
 * скрипт "public/assets/admin/js/localize.admin.js"
 * ==========================================================
 *
 *
 * @package App\Models
 *
 */
trait LocalizeTrait
{
//    protected $localized;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lang()
    {
        return $this->hasMany(Lang::class, 'for_id', 'id')->where('table', self::class);
    }

    public function __construct()
    {
        // TODO: Implement __wakeup() method.
        $this->fillable = array_merge(
            $this->fillable,
            collect($this->localized)->flatMap(
                function ($field) {
                    return collect(Locale::$languages)
                        ->map(
                            function ($lan) use ($field) {
                                return $field.'_'.$lan;
                            }
                        );
                }
            )->toArray()
        );
        $this->casts =array_merge(
            $this->casts,
            collect('attr')->flatMap(
                function ($field) {
                    return collect(Locale::$languages)
                        ->map(
                            function ($lan) use ($field) {
                                return $field.'_'.$lan;
                            }
                        );
                }
            )->toArray()
        );
       /* dd(collect($this->localized)->flatMap(
                function ($field) {
                    return collect(Locale::$languages)
                        ->map(
                            function ($lan) use ($field) {
                                return $field.'_'.$lan;
                            }
                        );
                }
            )->toArray(),$this);*/
    }


    public function getAttribute($key)
    {
        $locale = collect($this->localized)->flatMap(
            function ($field) {
                return collect(Locale::$languages)
                    ->map(
                        function ($lan) use ($field) {
                            return $field.'_'.$lan;
                        }
                    );
            }
        )->merge($this->localized);
        if ($locale->contains($key)) {
            if (in_array($key, $this->localized)) {
                return $this->lang()->whereField($key)->whereLang(app()->getLocale())->first()->content ?? '';
            }
            $ff = explode('_', $key);

            return $this->lang()->whereField($ff[0])->whereLang($ff[1])->first()->content ?? '';
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {

        $locale = collect($this->localized)->flatMap(
            function ($field) {
                return collect(Locale::$languages)
                    ->map(
                        function ($lan) use ($field) {
                            return $field.'_'.$lan;
                        }
                    );
            }
        );
        if ($locale->contains($key)) {

            if ($this->id) {
                $ff = explode('_', $key);

                if (!empty($value)) {
                    if ($lang = $this->lang()->where(['table' => self::class, 'field' => $ff[0], 'for_id' => $this->id, 'lang' => $ff[1]])->first()) {
                        $lang->update(['content' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value]);
                    } else {
                        $this->lang()->save(
                            new Lang(
                                [
                                    'table'   => self::class,
                                    'field'   => $ff[0],
                                    'for_id'  => $this->id,
                                    'content' => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value,
                                    'lang'    => $ff[1],
                                ]
                            )
                        );
                    }
                } else {
                    $this->lang()->where(['table' => self::class, 'field' => $ff[0], 'for_id' => $this->id, 'lang' => $ff[1]])->delete();
                }
            }

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

}