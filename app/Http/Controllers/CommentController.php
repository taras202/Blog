<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Збереження нового коментаря
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        Comment::create([
            'description' => $validatedData['description'],
            'avtor_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }

    // Форма для редагування коментаря
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    // Оновлення коментаря
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $comment->update($validatedData);

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment updated successfully.');
    }

    // Видалення коментаря
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment deleted successfully.');
    }
}
