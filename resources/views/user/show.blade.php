@extends('layouts.app')

@section('title', 'User Show')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>User Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"><strong>Full Name:</strong></label>
                            <p id="name">{{ $user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email:</strong></label>
                            <p id="email">{{ $user->email }}</p>
                        </div>
                        <div class="form-group">
                            <label for="created_at"><strong>Member Since:</strong></label>
                            <p id="created_at">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
