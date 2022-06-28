<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'media_id', 'description', 'short_description', 'year', 'age_limit', 'image', 'cinebazurl',
        'trailler_button_url', 'menu_show', 'page_show', 'home_show', 'is_active', 'created_by', 'modified_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function media()
    {
        // return $this->belongsTo(Media::class);
        return $this->belongsTo(Media::class);
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
