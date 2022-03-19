<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Nuovo post creato</h2>

    <h3>Titolo del post: {{$new_post->title}}</h3>

    <p>Per visualizzare il post clicca <a href="{{route('admin.posts.show', ['post' => $new_post->id])}}">qui</a></p>
</body>
</html>