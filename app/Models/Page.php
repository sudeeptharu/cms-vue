<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable=[
        'title','subtitle','description','draft', 'quote','excerpt','image','slug'
    ];
}
