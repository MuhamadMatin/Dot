@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <h1 class="text-center">Create Post</h1>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card w-50">
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <!-- Pesan Error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Content</label>
                        <textarea type="text" class="form-control" id="body" name="body" required></textarea>
                    </div>
                    <span class="d-flex">
                        <button type="submit" class="btn btn-primary mr-4">Create</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
