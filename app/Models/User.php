<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

use function Pest\Laravel\put;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        self::created(function (self $user) {
            $name = urlencode($user->first_name . '_' . $user->last_name);
            $avatar = file_get_contents("https://ui-avatars.com/api/?background=random&name={$name}");
            $path = storage_path("app/public/avatars/{$user->uuid}.png");
            \File::put($path, $avatar);
        });
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => asset('storage/avatars/' . $attributes['uuid'] . '.png' ),
        );
    }
}
