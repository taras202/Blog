<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        Comment::create([
            'description' => $request->validated()['description'],
            'avtor_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment updated successfully.');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment deleted successfully.');
    }
}
