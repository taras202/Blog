@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h2>Edit Comment</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="description" class="form-label">Edit your comment</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $comment->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
