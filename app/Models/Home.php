<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Home extends Model
{
    protected $fillable = ['title', 'slug', 'rooms', 'beds', 'bathrooms', 'address', 'latitude', 'longitude', 'cover_image', 'visible'];

    public static function createSlug($title)
    {
        $home_slug = Str::slug($title);
        return $home_slug;
    }

    use HasFactory;
}
