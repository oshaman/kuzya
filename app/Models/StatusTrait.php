<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 12/21/18
 * Time: 1:26 PM
 */

namespace App\Models;


trait StatusTrait
{

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

    public static function getAllowed()
    {
        return self::where('active', 1)->orderBy('priority')->get();
    }

}