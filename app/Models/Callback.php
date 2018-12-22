<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $fillable = ['email', 'copies'];


    public function getCopiesArrayAttribute()
    {
        return array_filter(array_map('trim', explode(',', $this->copies)));
    }
}
