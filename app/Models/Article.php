<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = [];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);

    }
    public function categories() {
        return $this->belongsToMany(Category::class);

    }
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rateBy()
    {
        return $this->belongsToMany(User::class, 'rates');
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
