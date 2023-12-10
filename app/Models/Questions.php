<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Questions extends Model
{
    // use Cachable;

    protected $table = 'posts';

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'community_owned_date';

    // можно получить
    protected $fillable = [
        'title', 
        'tags', 
        'body',
        'view_count', 
        'answer_count', 
        'community_owned_date',
        'creation_date',
    ];
    // нельзя отобразить
    protected $hidden = [
        'accepted_answer_id',
        'closed_date',
        'favorite_count',
        'last_editor_display_name',
        'owner_display_name',
        'post_type_id',
        'last_edit_date', 
        'last_editor_user_id',
        'score', 
        'parent_id', 
        'comment_count',
        'owner_user_id',
        'last_activity_date',
        'content_license'
    ];
    
}
