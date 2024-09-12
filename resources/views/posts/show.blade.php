@extends('layout')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3>{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $post->description }}</p>
                    <p><strong>Author ID:</strong> {{ $post->avtor_id }}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Add a Comment</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.store', $post) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment</label>
                            <textarea name="description" id="comment" class="form-control" rows="3" placeholder="Enter your comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    @if($post->comments->isEmpty())
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @else
                        @foreach($post->comments as $comment)
                            <div class="mb-3 p-3 border rounded">
                                <p>{{ $comment->description }}</p>
                                <p class="text-muted">By: {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</p>

                                <div class="d-flex">
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
