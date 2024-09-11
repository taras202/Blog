@extends('layout')

@section('content')
<h2>Edit Comment</h2>

<form action="{{ route('comments.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <textarea name="description" class="form-control" rows="3">{{ $comment->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update Comment</button>
</form>
@endsection
