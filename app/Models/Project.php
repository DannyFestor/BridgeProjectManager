<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $uuid
 */
class Project extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'description',
        'settings',
    ];

    protected static function booted()
    {
        parent::booted();

        static::created(function (self $model) {
            ProjectUser::create(
                [
                    'project_id' => $model->id,
                    'user_id' => $model->user_id,
                    'is_favorite' => true,
                    'is_manager' => true,
                    'settings' => $model->settings,
                ]
            );
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ProjectUser::class)->withPivot(['is_manager']);
    }
}
