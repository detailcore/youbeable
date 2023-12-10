<?php

namespace App\Http\Controllers\Api;

use App\Models\TranslatedPost;
use App\Jobs\CopyArticlesDbJobs;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ParserController extends Controller
{
    function processFiles() {
        // dd($this->getFiles()[0]);
        CopyArticlesDbJobs::dispatch(
            $this->getFiles()[0]
        );
    }

    function getFiles() {
        $array_files = Storage::disk('local')->files('translated_start');
        sort($array_files, SORT_NATURAL | SORT_FLAG_CASE); //сортировка массива файлов

        return $array_files;
    }
}
