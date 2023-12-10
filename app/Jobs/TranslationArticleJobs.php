<?php

namespace App\Jobs;

use App\Models\TranslatedPost;
use App\Models\PostsToTranslate;
use App\Http\Controllers\Api\TranslationController;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslationArticleJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $articles;

    /**
     * Create a new job instance.
     * @return void
     */
    
    public function __construct($array)
    {
        $this->articles = $array;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $articles = $this->articles;

        if($articles !== NULL || $articles !== []) {
            //*Отметка в Базе
            foreach($articles as $post) {
                PostsToTranslate::where('id', $post['id'])
                                ->update(['post_translated' => 1]);
            };

            //*Создание файла
            $this->create_html($articles);

            //*Выполнение метода @translate
            app()->call(TranslationController::class . '@translate');
        }
    }


    private function create_html($posts) 
    {
        $html_title_body = View::make('html_title_body', ['posts' => $posts]);
        Storage::disk('local')->put('translated_start/post_id_' . $posts[0]['id'] . '.html', $html_title_body->render());
    }
}
