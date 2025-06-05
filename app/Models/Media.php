<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Media extends Model
{
    protected $fillable = ['owner', 'type', 'name', 'image', 'description'];
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

}
