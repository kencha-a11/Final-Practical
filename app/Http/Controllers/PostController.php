<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('users_id', Auth::id())->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.   
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $validated['users_id'] = Auth::id(); 

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        $user = Auth::user();

        if ($user && $user->id === $post->users_id) {
            return view('posts.show', compact('post'));
        }

        return redirect()->route('posts.index')->with('error', 'accesing other posts');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $user = Auth::user();

        if ($user && $user->id === $post->users_id) {
            return view('posts.edit', compact('post'));
        }

        return redirect()->route('posts.index')->with('error', 'editing other posts');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        $user = Auth::user();

        if ($user && $user->id === $post->users_id) {
            $post->update($validated);
            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'updating other posts');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $user = Auth::user();

        if ($user && $user->id === $post->users_id) {
            $post->delete();
            return redirect()->route('login')->with('success', 'logout successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'loging out other user');
    }
}
