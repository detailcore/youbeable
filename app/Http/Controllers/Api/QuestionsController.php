<?php

namespace App\Http\Controllers\Api;

use App\Models\Questions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
// популярное на главной
    public function topHome()
    {
        //? Было на русском
        // return Questions::whereNotNull('title')
        // ->orderBy('view_count', 'desc')
        // ->take(10)
        // ->select('id', 'title')
        // ->get();

        //? Стало на ангельском
        return Questions::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
        ->select('posts.id', 'translated_posts.title')
        ->wherePostTypeId(1)
        ->orderBy('view_count', 'desc')
        ->take(10)
        ->get();
    }

// новое на главной
    public function newHome()
    {
        //? Было на русском
        // return Questions::whereNotNull('title')
        // ->orderBy('creation_date', 'desc')
        // ->take(10)
        // ->select('id', 'title')
        // ->get();

        //? Стало на ангельском
        return Questions::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
        ->select('posts.id', 'translated_posts.title')
        ->wherePostTypeId(1)
        ->orderBy('creation_date', 'desc')
        ->take(10)
        ->get();
    }

// Получить статьи по тегу
    public function getQuestionsTag(Questions $questions, $alias)
    {
        //? Было на русском
        // $postItem = $questions
        //     ->where('tags', 'like', '%<'.$alias.'>%')
        //     ->orderBy('creation_date', 'desc')
        //     ->paginate(12);

        //? Стало на ангельском
        $postItem = $questions
            ->join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
            ->where('posts.tags', 'like', '%<'.$alias.'>%')
            ->orderBy('creation_date', 'desc')
            ->paginate(12);

        abort_unless($postItem, 404, 'Not Found');

        foreach($postItem as $key => $value) {
            $text = stristr($value['body'], '<pre>', true);
            
            if( $text ) {
                $truncated = Str::limit(strip_tags($text), 400);
                $postItem[$key]['body'] = $truncated;
            } else {
                $text2 = $value['body'];
                $truncated = Str::limit(strip_tags($text2), 400);
                $postItem[$key]['body'] = $truncated;
            }
        }

        return $postItem;
    }
}
