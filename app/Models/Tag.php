<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'name'];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new OwnerScope);
    }
}
