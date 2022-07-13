<?php

namespace App\Models;

use App\Contracts\Comment\Commentable;
use App\Contracts\Like\Likeable;
use App\Models\Concern\Comments;
use App\Models\Concern\Likes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Commentable, Likeable
{
    use HasFactory, SoftDeletes, SoftDeletes, Comments, Likes;

    protected $guarded = [];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productGalleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }
}
