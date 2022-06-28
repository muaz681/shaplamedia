<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug',
        'remarks', 'is_active', 'created_by', 'modified_by'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }



    // public function seo()
    // {
    //     return $this->morphOne(Seo::class, 'seoable');
    // }

    // public function banner()
    // {
    //     return $this->hasMany(Banner::class);
    // }

    public function media()
    {
        // return $this->hasMany(Media::class);
        return $this->belongsToMany(Media::class, 'media_category');
    }
}
