<?php

namespace App\Helper;

class AvatarHelper
{
    public static function make(string $firstName, string $lastName, string $uuid): void
    {
        $name = urlencode($firstName.' '.$lastName);
        $avatar = file_get_contents("https://ui-avatars.com/api/?background=random&name={$name}");
        $path = storage_path("app/public/avatars/{$uuid}.png");
        \File::put($path, $avatar);
    }
}
