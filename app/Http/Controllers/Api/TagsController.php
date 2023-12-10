<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    // Топ 12 тегов по кол-ву вопросов
    public function top()
    {
        return Tag::orderBy('count', 'desc')
        ->take(12)
        ->get();  
    }

    // Список тегов и описание к ним
    public function listShort()
    {
        $tags = Tag::orderBy('count', 'desc')
        ->paginate(30);
        
        foreach( $tags as $key => $value ) {
            //? Было на русском
            // $desc = Post::whereId($value['excerpt_post_id'])->first();
            //? Стало на ангельском
            $desc = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                        ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
                        ->where('posts.id', '=', $value['excerpt_post_id'])
                        ->first();

            abort_unless($desc, 404, 'Not Found');
            
            $value['description'] .= $desc['body'];
            // $value['description'] .= strip_tags($desc['body']);
        }
        return $tags;
    }

    // Описание тега названию
    public function tagDesc($alias)
    {
        $tag = Tag::whereTagName($alias)
            ->first();

        // $desc = Questions::whereId($tag['wiki_post_id'])
        //     ->first();

        $desc = Questions::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->where('posts.id', '=', $tag['wiki_post_id'])
            ->first();

        abort_unless($item, 404, 'Not Found');

        return $desc['body'];
    }

    // Описание тега id
    public function getDescTag(Post $post, $id)
    {
        // $item = $post
        //     ->whereId($id)
        //     ->first();

        $item = $post
            ->join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->where('posts.id', '=', $id)
            ->first();

        abort_unless($item, 404, 'Not Found');

        return $item['body'];
    }

    // Короткое описание тега и кол-во вопросов
    public function getDescByAlias($alias)
    {
        $tag = Tag::whereTagName($alias)
            ->first();

        // dd($tag);        
        //? Было на русском
        // $desc = Questions::whereId($tag['excerpt_post_id'])
        //     ->first();
        
        //? Стало на ангельском
        $desc = Questions::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->where('posts.id', '=', $tag['excerpt_post_id'])
            ->first();

        abort_unless($desc, 404, 'Not Found');

        $item = [
            'count' => $tag['count'],
            'text' => $desc['body']
        ];

        return $item;
    }   


    // Конкретная статья
    public function get(Questions $post, $alias)
    {
        $postItem = $post
            ->whereId($alias)
            ->whereNull('parent_id')
            ->first();

        abort_unless($postItem, 404, 'Not Found');

        return $postItem;
    }
}
