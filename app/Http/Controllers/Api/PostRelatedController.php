<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Related;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostRelatedController extends Controller
{
    // Похожие вопросы
    public function getRelated(Request $request)
    {
        $id = $request->query('id');

        $postItem = Related::wherePostId($id)
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();

        foreach($postItem as $value) {
            //? Было на русском
            // $related = Post::whereId($value['related_post_id'])->first();
            //? Стало на ангельском
            $related = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                            ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
                            ->where('posts.id', '=', $value['related_post_id'])
                            ->first();

            
            $value['related_title'] = $related['title'];
            
            $text = $related['body'];
            $value['related_body'] = Str::limit(strip_tags($text), 350);
        }
            
        return $postItem;
    }
}
