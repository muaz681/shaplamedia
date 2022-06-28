<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'media_type', 'ratings', 'release_date', 'run_time', 'website', 'company', 'description', 'link','cinebazurl', 'potraitimage', 'landscapeimage', 'created_by', 'modified_by', 'extra_css',
        'remarks', 'sort_by', 'is_active', 'modified_by', 'budget', 'box_office', 'parent_id', 'related_media', 'sound_mix', 'filming_location', 'country_origin', 'language'
    ];


    public function banner()
    {
        return $this->hasOne(Banner::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'parent_id');
    } 


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'media_category');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'media_tag');
    }

    public function relatedMedia()
    {
        return $this->belongsToMany(Media::class, 'media_relations', 'media_id', 'related_media_id');
    }
    // public function mediaimage()
    // {
    //     return $this->hasMany(MediaImage::class);
    // }

    public function entity()
    {
        return $this->belongsToMany(Entity::class, 'media_entity')->withPivot(['role_id', 'character_name']);
    }
    public function entities()
    {
        return $this->belongsToMany(Entity::class, 'media_entity')->withPivot(['role_id', 'character_name']);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'media_entity');
    }

    public function getEntitiesByRole($role_id)
    {
        $entities = MediaEntity::where(['media_id' => $this->id, 'role_id' => $role_id])->get()->toArray();
        if ($entities)
            return $entities;
        else
            return [['id' => 0, 'entity_id' => null, 'role_id' => $role_id, 'character_name' => null, 'is_new' => true]];
    }

    /*
    *   array $role
    *   return array
    */
    public function getEntitiesByOtherRoles($roles)
    {
        $entities = MediaEntity::where(['media_id' => $this->id])
                                    ->whereNotIn('role_id', $roles)
                                    ->get()
                                    ->toArray();
        if ($entities)
            return $entities;
        else
            return [['id' => 0, 'entity_id' => null, 'role_id' => null, 'character_name' => null, 'is_new' => true]];
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }


    // public function getEntitiesObjectByRole($role_id)
    // {
    //     $entities = MediaEntity::where(['media_id' => $this->id, 'role_id' => $role_id])->get();
    //     if ($entities)
    //         return $entities;
    //     else
    //         return [['id' => 0, 'entity_id' => null, 'role_id' => $role_id, 'character_name' => null, 'media_id' => null]];
    // }
}
