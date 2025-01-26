<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/posts/index.css')}}">
    <title>Posts</title>
</head>
<body>
    <div class="space">
        <h1>Posts</h1>
        <br><a href="{{route('dashboard')}}"><button>go back</button></a>
        <br><a href="{{route('posts.create')}}"><button>create posts</button></a>
        <hr>
        <div>
            @forelse ($posts as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <a href="{{route('posts.show', $post->id)}}"><button>show post</button></a>
                </div> 
            @empty
                <p>No posts available.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
