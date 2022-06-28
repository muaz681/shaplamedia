<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaEntity extends Model
{
    use HasFactory;

    protected $table = 'media_entity';
    protected $fillable = ['media_id', 'entity_id', 'role_id', 'character_name'];

    public function getMediaEntityByRole($media_id, $role_id)
    {
        return $this->leftjoin('entities', 'entities.id', 'media_entity.entity_id')
            ->select('entities.id', 'entities.name', 'entities.slug')
            ->where('media_entity.media_id', $media_id)
            ->where('media_entity.role_id', $role_id)
            ->get();
    }

    public function getRoles($media_id)
    {
        $roles = $this->leftjoin('entities', 'entities.id', 'media_entity.entity_id')
            ->leftjoin('roles', 'roles.id', 'media_entity.role_id')
            ->select('entities.id', 'entities.name', 'entities.slug', 'media_entity.role_id', 'roles.title as role_name')
            ->where('media_entity.media_id', $media_id)
            ->get();
        $result = [];
        if(!$roles) {
            return false;
        }
        foreach($roles as $r) {
            $result[$r->role_name][] = $r;
        }
        return $result;
    }
}
