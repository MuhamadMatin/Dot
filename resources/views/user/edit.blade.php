@extends('layouts.app')

@section('title', 'User Edit')

@section('content')
    <h1 class="text-center">Edit User</h1>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card w-50">
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                        <label for="name">Full Name</label>
                        <input value="{{ $user->name }}" type="text" class="form-control" id="name" name="name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input value="{{ $user->email }}" type="email" class="form-control" id="email" name="email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            @if ($user->id !== auth()->user()->id) disabled @endif>
                        @if ($user->id !== auth()->user()->id)
                            <small class="form-text text-muted">You not user account password for this user.</small>
                        @endif
                    </div>
                    <span class="d-flex">
                        <button type="submit" class="btn btn-primary mr-4">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
