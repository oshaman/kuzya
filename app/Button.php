<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    protected $fillable = ['link'];


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

    public static function getLoginBlock()
    {
        return static::where('title', 'Кнопка входа')->first();
    }
}
