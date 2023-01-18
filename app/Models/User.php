<?php

namespace App\Models;

use App\Helper\AvatarHelper;
use App\Traits\HasUUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        self::updating(function (self $user) {
            if (
                Str::upper(Str::substr($user->first_name, 0, 1)) !== Str::upper(Str::substr($user->getOriginal('first_name'), 0, 1)) ||
                Str::upper(Str::substr($user->last_name, 0, 1)) !== Str::upper(Str::substr($user->getOriginal('last_name'), 0, 1))
            ) {
                AvatarHelper::make($user->first_name, $user->last_name, $user->uuid);
            }
        });

        self::created(function (self $user) {
            AvatarHelper::make($user->first_name, $user->last_name, $user->uuid);
        });
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => asset('storage/avatars/' . $attributes['uuid'] . '.png' ),
        );
    }

    /**
     * @return HasMany
     */
    public function ownedProjects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
