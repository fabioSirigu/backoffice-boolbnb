<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public static function createSlug($title)
    {
        $home_slug = Str::slug($title);
        return $home_slug;
    }
    /**
     * The tags that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
