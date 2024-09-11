<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function authenticate(Request $request)
    {
        // Валідатор даних
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Спроба аутентифікації
        if (Auth::attempt($credentials)) {
            // Якщо аутентифікація успішна
            $request->session()->regenerate();

            // Перенаправлення на потрібну сторінку
            return redirect()->intended('dashboard');
        }

        // Якщо аутентифікація не вдалася
        return back()->withErrors([
            'email' => 'Неправильний email або пароль.',
        ])->onlyInput('email');
    }


    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request, Post $post)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $post = Post::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'avtor_id' => Auth::id(),
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}


    
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
