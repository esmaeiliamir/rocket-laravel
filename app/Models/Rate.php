<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'commentable_id', 'rate'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'rating_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
