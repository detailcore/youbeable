<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Post extends Model
{
    // use Cachable;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'community_owned_date';

    // можно получить
    protected $fillable = [
        'title', 
        'score', 
        'tags', 
        'body',
        'parent_id', 
        'view_count', 
        'answer_count', 
        'comment_count', 
        'creation_date',
        'owner_user_id',
        'community_owned_date',
    ];

    // нельзя отобразить
    protected $hidden = ['updated_at', 'deleted_at', 'last_edit_date', 'last_editor_user_id', 'last_activity_date', 'content_license'];


}
