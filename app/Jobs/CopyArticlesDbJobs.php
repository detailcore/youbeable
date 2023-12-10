<?php

namespace App\Jobs;

use DiDom\Document;
use Illuminate\Support\Str;
use App\Models\TranslatedPost;
use App\Http\Controllers\Api\ParserController;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;


class CopyArticlesDbJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    /**
     * Create a new job instance.
     * @return void
     */
    
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = $this->file;
        $posts = [];
        
        $html_path = Storage::disk('local')->path($file);
        $document = new Document();
        $document->loadHtmlFile($html_path);

        $zero_content = $document->find('#my_content_to_translate_Q_Q');
        
        foreach($zero_content as $content)
        {
            $id = $content->find('.content_html_id_Q_Q')[0]->innerHtml();

            $title = $content->find('.content_html_title_Q_Q')[0]->innerHtml();
                preg_match_all('/{(.*?)}/m', $title, $title_matche, PREG_SET_ORDER, 0);
                $title_trim_space = htmlspecialchars_decode(trim($title_matche[0][1]));

                if($title_trim_space == "") {
                    $title_trim_space = NULL;
                }

                // dd(
                //     (int)$id,
                //     $title_trim_space
                // );

            $body = $content->find('.content_html_body_all_Q_Q')[0]->innerHtml();
                $body_replaced_first = Str::of($body)->replaceFirst('{', '');
                $body_replaced = Str::of($body_replaced_first)->replaceLast('}', '');
                // $body_trim_space = htmlspecialchars_decode(trim($body_replaced));

            var_dump(
                (int)$id,
                // htmlspecialchars_decode($title_trim_space)
            );
            array_push(
                $posts,
                [
                    'post_id' => (int)$id,
                    'title' => $title_trim_space,
                    'body' => trim($body_replaced)
                ]
            );
        }

        // dd($posts[11]);

        TranslatedPost::insert($posts); //* отправка в Базу всего массива статей
        
        //!Перемещение прочитанного файла
        $filename = Str::of($file)->match('/\/(.*?)$/');
        Storage::disk('local')->move($file, 'translated_end/'.$filename);


        // sleep(2);
        // dd('Test1');
        // *Выполнение метода контроллера
        app()->call(ParserController::class . '@processFiles');
    }
}
