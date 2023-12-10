<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Search extends Model
{
    // use Cachable;

    protected $table = 'posts';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'community_owned_date';

    // можно получить
    protected $fillable = [
        'title', 
        'body',
    ];

    // нельзя отобразить
    protected $hidden = [
        'score', 
        'tags', 
        'updated_at', 
        'deleted_at', 
        'last_edit_date', 
        'last_editor_user_id', 
        'content_license',
        'parent_id', 
        'view_count', 
        'answer_count', 
        'comment_count', 
        'creation_date',
        'owner_user_id',
        'accepted_answer_id',
        'closed_date',
        'community_owned_date',
        'favorite_count',
        'last_activity_date',
        'last_editor_display_name',
        'owner_display_name'
    ];
    
}
