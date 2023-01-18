<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $casts = [
        'settings' => 'json',
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
