<?php


namespace App\Traits;


trait Filter
{
    public function scopeFilter($query, $arr)
    {
        foreach ($arr as $field => $value) {
            $query->where($field, 'like', $value . '%');
        }
    }
}
