<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'is_published'=>0
    ];
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
