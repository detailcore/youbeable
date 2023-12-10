<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Tag extends Model
{
    // use Cachable;

    protected $table = 'tags';
    

    // можно получить
    protected $fillable = [
        'id', 
        'tag_name', 
        'count',
        'wiki_post_id'
    ];

    // нельзя отобразить
    protected $hidden = ['excerpt_post_id'];


}
