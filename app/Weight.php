<?php

namespace App;

use App\Traits\Filter;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use Filter;

    protected $guarded = [];

    public static function findOneBySn($sn)
    {
        return self::where('sn', $sn)->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
