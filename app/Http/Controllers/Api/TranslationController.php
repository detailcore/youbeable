<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Models\TranslatedPost;
use App\Models\PostsToTranslate;
use App\Jobs\TranslationArticleJobs;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class TranslationController extends Controller
{
    //
    function translate() {
        $getPosts = PostsToTranslate::select('id', 'post_translated', 'title', 'body',)
                        ->whereIn('post_type_id', [4])
                        ->wherePostTranslated(0)
                        ->take(220)
                        ->get();

        if($getPosts == NULL || $getPosts[0] == []) {
            $getPosts = array();
        }

        // dd($getPosts);

        TranslationArticleJobs::dispatch(
            $getPosts
        );
    }
}
