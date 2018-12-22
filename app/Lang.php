<?php


namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lang
 *
 * @package App
 * @property int    id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string table
 * @property string field
 * @property int    for_id
 * @property string content
 * @property string lang
 */
class Lang extends Model
{
    protected $fillable
        = [
            'table',
            'field',
            'for_id',
            'content',
            'lang',
        ];
}
