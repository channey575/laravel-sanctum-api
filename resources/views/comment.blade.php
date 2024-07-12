@extends('layouts.app')

@section('content')
<style>
    .container {
        padding: 20px;
        max-width: 900px;
        margin: auto;
    }
    .comment {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        padding: 15px;
        margin-bottom: 20px;
    }
    .comment-body {
        font-style: italic;
        margin-bottom: 10px;
    }
    .comment-actions {
        margin-top: 10px;
    }
    .btn {
        padding: 10px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-danger {
        background-color: #dc3545;
    }
    .btn-link {
        color: #007bff;
        text-decoration: none;
    }
    .btn-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>Comments for Post: {{ $post->title }}</h1>

    <!-- Display Comments -->
    @forelse ($comments as $comment)
        <div class="comment">
            <div class="comment-body">{{ $comment->body }}</div>

            <!-- Comment Actions -->
            @can('update', $comment)
                <a href="{{ route('comments.edit', $comment) }}" class="btn btn-primary">Edit Comment</a>
            @endcan
            @can('delete', $comment)
                <form method="POST" action="{{ route('comments.destroy', $comment) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Comment</button>
                </form>
            @endcan
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse

    <!-- Add Comment Form -->
    @can('create', App\Models\Comment::class)
        <div class="mb-4">
            <h4>Add Comment</h4>
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <textarea id="body" class="form-control" name="body" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    @endcan
</div>
@endsection
