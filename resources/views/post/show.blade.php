@extends('layouts.app')

@section('title', 'Post Show')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $post->title }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="author"><strong>Author:</strong></label>
                            <p id="author">{{ $post->user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="created_at"><strong>Published on:</strong></label>
                            <p id="created_at">{{ $post->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="body"><strong>Content:</strong></label>
                            <p id="body">{{ $post->body }}</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
