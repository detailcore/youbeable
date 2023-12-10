<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\User;
use App\Events\SearchEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Страница со всеми статьями где есть заголовок
    public function list()
    {
        return Post::whereNotNull('title')
        ->latest()
        ->paginate(12);
    }

    // Конкретная статья
    public function get(Post $post, $alias)
    {
        //? Было на русском
        // $postItem = $post
        //     ->whereId($alias)
        //     ->wherePostTypeId(1)
        //     ->first();

        //? Стало на ангельском
        $postItem = $post
            ->join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
            ->wherePostId($alias)
            ->wherePostTypeId(1)
            ->first();

        $user = User::whereId($postItem['owner_user_id'])->first();
        $name = $user['display_name'];

        if($postItem['owner_display_name'] != $name) {
            Post::whereId($postItem['id'])->update(['owner_display_name' => $name]);
        }

        abort_unless($postItem, 404, 'Not Found');

        return $postItem;
    }

    // Ответы на конкретную статью
    public function getAnswers(Post $post, $alias)
    {
        //? Было на русском
        // $postItem = $post
        //     ->whereParentId($alias)
        //     ->get();

        //? Стало на ангельском
        $postItem = $post
            ->join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
            ->whereParentId($alias)
            ->get();
            
        
        foreach($postItem as $key => $value) {
            $user_id = $value['owner_user_id'];

            if( empty($user_id) ) {
                $user_id = -1;
            }
            $user = User::whereId($user_id)->first();
            $name = $user['display_name'];
            if($postItem[$key]['owner_display_name'] != $name) {
                Post::whereId($value['id'])->update(['owner_display_name' => $name]);
            }
        };
        
        // dd($postItem);

        abort_unless($postItem, 404, 'Not Found');

        return $postItem;
    }

    // Топ. Популярные ответы 
    public function getTopAnswers()
    {
        //? Было на русском
        // $item = Post::wherePostTypeId(2)
        //             ->orderBy('score', 'DESC')
        //             ->take(15)
        //             ->get();

        //? Стало на ангельском
        $item = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
                ->where('posts.post_type_id', '=', 2)
                ->orderBy('score', 'DESC')
                ->take(15)
                ->get();
                    
                // dd($item);

        abort_unless($item, 404, 'Not Found');

        foreach($item as $value) {
            //? Было на русском
            // $question = Post::whereId($value['parent_id'])->first();
            //? Стало на ангельском
            $question = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                ->where('posts.id', '=', $value['parent_id'])
                ->first();

            $value['title'] = $question['title'];
            
            //массив тегов
            $tmp_tag_str = str_replace(">", "", $question['tags']);
            $tmp_tag_arr = explode('<', $tmp_tag_str);
            $value['tags'] = array_diff($tmp_tag_arr, array('', NULL, false));

            $text = stristr($value['body'], '<pre>', true);
            $value['body'] = Str::limit(strip_tags($text), 350);
        }

        return $item;        
    }

    //Получить вопросы по сортировке из запроса
    public function getTopQuestions(Request $request)
    {
        $query = $request->query('sort');

        if($query === 'topnew') {
            //? Было на русском
            // $questions = Post::wherePostTypeId(1)
            //             ->latest()
            //             ->paginate(12);
            //? Стало на ангельском
            $questions = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                    ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
                    ->wherePostTypeId(1)
                    ->latest()
                    ->paginate(12);
        }

        if($query === 'toptop') {
            //? Было на русском
            // $questions = Post::wherePostTypeId(1)
            //             ->orderBy('score', 'DESC')
            //             ->paginate(12);
            //? Стало на ангельском
            $questions = Post::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
                    ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
                    ->wherePostTypeId(1)
                    ->orderBy('score', 'DESC')
                    ->paginate(12);
        }

        //удалить html теги из описания
        foreach($questions as $key => $value) {
            $text = stristr($value['body'], '<pre>', true);
            
            if( $text ) {
                $truncated = Str::limit(strip_tags($text), 355);
                $questions[$key]['body'] = $truncated;
            } else {
                $text2 = $value['body'];
                $truncated = Str::limit(strip_tags($text2), 355);
                $questions[$key]['body'] = $truncated;
            }
        }
            
        return $questions;
    }
    
}
