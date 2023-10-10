<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey='id';
    public $incrementing=false;
    protected $fillable=[
        'gallery_id','image'
    ];
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
