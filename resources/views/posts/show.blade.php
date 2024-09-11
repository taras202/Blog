@extends('layout')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

</head>  
<div class="row">
    <div class="col-md-8 offset-md-2">
    <div class="card-body">
                <p><strong>Title:</strong> {{ $post->title }}</p>
                <p><strong>Description:</strong> {{ $post->description }}</p>
        <p><strong>Author ID:</strong> {{ $post->avtor_id }}</p>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
<h4>Add a Comment</h4>
<form action="{{ route('comments.store', $post) }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea name="description" class="form-control" rows="3" placeholder="Enter your comment"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
</form>

<h4>Comments</h4>
@foreach($post->comments as $comment)
    <p>{{ $comment->description }}</p>
    <p>By: {{ $comment->user->name }} on {{ $comment->created_at->format('d M Y') }}</p>

    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
@endforeach

@endsection
