<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{  
    use HasFactory;
    protected $fillable = ['name', 'slug', 'image', 'role_id', 'description', 'company', 'gender', 'designation', 'created_by', 'modified_by'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'entity_role');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'media_entity');
    }

    public function distinctMediaen()
    {
        return $this->belongsToMany(Media::class, 'media_entity')->distinct()->take(4);
    }
    public function distinctMedia()
    {
        return $this->belongsToMany(Media::class, 'media_entity')->distinct();
    }
    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
