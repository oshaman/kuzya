<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.06.2018
 * Time: 11:18
 */

namespace App\Models;


trait SeoTrait
{
    public function getSeoAttribute($key)
    {
        return $this->{'seo'.app()->getLocale()};
    }

    public function seoru()
    {
        return $this->hasOne(Seo::class, 'id', 'seo_id_ru');
    }

    public function seouk()
    {
        return $this->hasOne(Seo::class, 'id', 'seo_id_uk');
    }

    public function saveSeo($request)
    {
        if ($Request_seo = $request->get('Seo')) {
            foreach ($Request_seo as $lang => $seoReq) {
                if (!$seo = $this->{'seo'.$lang}) {
                    $seo = new Seo();
                }
                $seoReq = array_diff($seoReq, ['' => '']);
                if (count($seoReq)) {
                    $seo->fill($seoReq)->save();
                    $this->{'seo_id'.($lang ? '_'.$lang : '')} = $seo->id;
                }
            }
            $this->save();

        }
    }
}