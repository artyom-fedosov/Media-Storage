<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property string $uuid
 * @property string $owner
 * @property string $type
 * @property string $name
 * @property string $route
 * @property string $description
 **/
class Media extends Model
{
    protected $fillable = ['owner', 'type', 'name', 'image','route', 'description'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'uuid';
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_media')->withPivot('read', 'write');
    }

    public function getKeywordsStringAttribute():string
    {
        return $this->keywords->pluck('name')->join(', ');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(!$model->uuid) {
                $model->uuid = (string)Str::uuid();
            }
        });
    }

    public function sharedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_media', 'media_uuid', 'user_login')
            ->withPivot('read', 'write')
            ->withTimestamps();
    }
}
