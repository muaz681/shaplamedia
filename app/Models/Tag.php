<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'remarks', 'created_by', 'modified_by'];

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'media_tag');
    }
}
