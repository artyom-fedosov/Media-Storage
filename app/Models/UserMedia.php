<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMedia extends Pivot
{
    protected $table = 'user_media';
    protected $fillable = ['user_id', 'media_id', 'read', 'write'];
}
