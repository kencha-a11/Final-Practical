<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/posts/show.css')}}">
    <title>Post Details</title>
</head>
<body>
    <div class="container">
        <h1> {{ $post->title }}</h1>
        <p> {{ $post->body }}</p>
        <hr>
        <p>created: {{ $post->created_at}}</p>
        <p>updated: {{ $post->updated_at}}</p>
        <br>
        <a href="{{ route('posts.edit', $post->id) }}"><button>Edit Here</button></a>
        
        <br><a href="{{ route('posts.index') }}"><button>Back to Posts</button></a>
    </div>
</body>
</html>