@extends('layouts.app')

@section('title', 'Users Index')

@section('content')
    <div class="container">
        <h1>User page</h1>
        <a href="{{ route('users.create') }}">Create User</a>
        <!-- Search -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-3 w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search posts..."
                    value="{{ request()->input('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-primary">Show</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h3>User empty</h3>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {!! $users->links() !!}
        </div>
    </div>
@endsection
