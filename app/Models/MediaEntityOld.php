<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaEntity extends Model
{
    use HasFactory;

    protected $table = 'media_entity';
    protected $fillable = ['media_id', 'entity_id', 'role_id'];
}
