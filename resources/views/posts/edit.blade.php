<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/posts/edit.css')}}">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div>
                <label for="body">Body:</label>
                <textarea name="body" id="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
            </div>
            <button type="submit">Update Post</button>
        </form>

        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete">Delete</button>
        </form>
        <a href="{{route('posts.index')}}" class="return"><button>return</button></a>
    </div>
</body>
</html>
