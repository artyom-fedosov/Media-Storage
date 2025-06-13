<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Keyword extends Model
{
    protected $fillable=['name'];

    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class);
    }
}
