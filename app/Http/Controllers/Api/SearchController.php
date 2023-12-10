<?php

namespace App\Http\Controllers\Api;

use App\Models\Search;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    
    public function getSearch(Request $request)
    {
        $query = $request->query('query');
        // $answers = Search::whereNotNull('title')
        //     ->where('title', 'like', '%' . $query . '%')
        //     // ->orWhere('body', 'like', '%' . $query . '%')
        //     ->take(10)
        //     ->get();

        $answers = Search::join('translated_posts', 'posts.id', '=', 'translated_posts.post_id')
            ->select('posts.id', 'translated_posts.title')
            ->wherePostTypeId(1)
            ->where('translated_posts.title', 'like', '%' . $query . '%')
            ->take(10)
            ->get();

            
            
        return $answers;
    }
    
}
