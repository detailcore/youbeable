<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $posts[0]['id'] }}</title>
  </head>
  <body>
    <div id="content_html_body_Q_Q">
      @foreach ($posts as $post)
      <div id="my_content_to_translate_Q_Q">
        <div class="content_html_id_Q_Q">{{ $post['id'] }}</div>
        <div class="content_html_title_Q_Q">{ {{ $post['title'] }} }</div>
        <div class="content_html_body_all_Q_Q">{{!! $post['body'] !!}}</div>
      </div>
      @endforeach
    </div>
  </body>
</html>
