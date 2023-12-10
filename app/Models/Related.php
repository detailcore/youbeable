<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Related extends Model
{
    // use Cachable;

    protected $table = 'post_links';

    const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'community_owned_date';

    // можно получить
    protected $fillable = [
        'id', 
        'post_id', 
        'related_post_id', 
        'creation_date'
    ];

    // нельзя отобразить
    protected $hidden = [
        'link_type_id'
    ];


}
