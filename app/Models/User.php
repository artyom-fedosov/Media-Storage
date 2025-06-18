<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $login
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $themeStyle
 * @property string $density
 * @property string $language
 **/
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'theme_style',
        'density',
        'language',
    ];

    protected $primaryKey = 'login';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'user_media',
            'user_login', 'media_uuid')->withPivot('read', 'write');
    }

    public function canAccess(Media $media): bool
    {
        return $media->sharedUsers()
            ->where('user_login', $this->login)
            ->wherePivot('read', true)
            ->exists();
    }

    public function setting(): HasOne
    {
        return $this->hasOne(Setting::class, 'user_login', 'login');
    }
}
