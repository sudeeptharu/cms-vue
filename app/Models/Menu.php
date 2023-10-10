<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable=[
        'title','is_published','opens_in_new_tab','url', 'parent_id','order'
    ];
    public function children()
    {
        return $this->hasMany('Menu','parent_id','id');
    }
}
