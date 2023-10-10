<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Category extends Model
{
    use HasUuids;
    use HasFactory;
    protected $fillable=[
        'title'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'category_post');
    }
}
