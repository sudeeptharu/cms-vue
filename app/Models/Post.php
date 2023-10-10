<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable=[
        'title','subtitle','description','draft', 'quote','excerpt','image'
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,'category_post',
            'category_id',
            'post_id');
    }
}
