<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Snkey extends Model
{
    protected $guarded = [];

    public function scopeFilter(Builder $builder)
    {
        $allow_filters = [
            'sn',
            'key',
        ];

        $filters = request()->query();

        foreach ($filters as $filter_field => $filter_value) {
            if (in_array($filter_field, $allow_filters, true)) {
                $builder->where($filter_field, 'like', $filter_value . '%');
            }
        }
    }
}
