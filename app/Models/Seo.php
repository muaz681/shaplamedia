<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $table = 'seos';
    protected $fillable = [
        'meta_title', 'seoable_id', 'seoable_type', 'meta_description', 'meta_keywords', 'canonical_tag', 'meta_type', 'meta_image',
        'remarks', 'sort_by', 'is_active', 'created_by', 'modified_by'
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
