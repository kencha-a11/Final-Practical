<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/posts/create.css') }}">
    <title>Create Post</title>
</head>
<body>

    <div class="forms">
        <form action="{{ route('posts.store') }}" method="POST">
            <h1>Create a New Post</h1>
            @csrf
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div>
                <label for="body">Body:</label>
                <textarea name="body" id="body" rows="5" >{{ old('body') }}</textarea>
            </div>
            <button type="submit">Create Post</button>
    
        </form>
        <a href="{{route('posts.index')}}"><button class="red">go back</button></a>    
    </div>
</body>
</html>
