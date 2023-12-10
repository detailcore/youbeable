<?php

namespace App\Http\Controllers\Api;

use App\Models\PostShort;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostShortController extends Controller
{

    public function short()
    {
        //? Было на русском
        // $descr = PostShort::wherePostTypeId(1)
        //     ->orderBy('creation_date', 'DESC')
        //     ->paginate(12);

        //? Стало на ангельском
        $descr = PostShort::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->select('posts.*', 'translated_posts.title', 'translated_posts.body')
            ->wherePostTypeId(1)
            ->orderBy('creation_date', 'DESC')
            ->paginate(12);
        
        foreach($descr as $key => $value) {
            $text = stristr($value['body'], '<pre>', true);
            
            if( $text ) {
                $truncated = Str::limit(strip_tags($text), 355);
                $descr[$key]['body'] = $truncated;
            } else {
                $text2 = $value['body'];
                $truncated = Str::limit(strip_tags($text2), 355);
                $descr[$key]['body'] = $truncated;
            }
        }

        return $descr;        
    }
}
