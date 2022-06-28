<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'metadescription', 'about_description', 'meta_title', 'about_image', 'chairman_image', 'mission_image', 'vision_image', 'message_chairman', 'mission', 'vision',  'created_by', 'modified_by'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
