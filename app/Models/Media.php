<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Media extends Model
{
    protected $fillable = ['owner', 'type', 'name'];

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('read', 'write');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }

}
