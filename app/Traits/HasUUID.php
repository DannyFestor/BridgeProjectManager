<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID()
    {
        static::creating(function (self $model) {
            $model->uuid = Str::uuid();
        });
    }
}
