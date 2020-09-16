<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sns extends Model
{
    protected $table = 'snss';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
