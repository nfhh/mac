<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public static function findOneByTitle($title)
    {
        return self::where('title', $title)->first();
    }
}
