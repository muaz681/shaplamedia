<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaImage extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'media_id', 'image', 'created_by', 'modified_by'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
