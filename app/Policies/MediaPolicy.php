<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;

class MediaPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Media $media)
    {
        if ($user->role === 'admin') {
            return true;
        }
        return $media->owner === $user->login
            || $media->owners()->where('login', $user->login)->exists();
    }
}
