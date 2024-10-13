@extends('layouts.app')

@section('title', 'Posts Index')

@section('content')
    <div class="container">
        <h1>post page</h1>
        <a href="{{ route('post.create') }}">Create Post</a>
        <!-- Search -->
        <form action="{{ route('posts.index') }}" method="GET" class="mb-3 w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search posts..."
                    value="{{ request()->input('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        {{ $posts->perPage() }}
        {{ $posts->currentPage() - 1 }}
        {{-- {{ $loop->iteration }} --}}

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Body</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->body }}</td>
                        <td>
                            <a href="{{ route('post.show', $post) }}" class="btn btn-sm btn-primary">Show</a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('post.delete', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h3>Post empty</h3>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
