<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    public static function bootHasUUID(): void
    {
        static::creating(function (self $model) {
            $model->uuid = Str::uuid();
        });
    }
}
