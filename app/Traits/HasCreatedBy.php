<?php

namespace App\Traits;

trait HasCreatedBy
{
    protected static function bootHasCreatedBy()
    {
        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }
}
