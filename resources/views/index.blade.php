@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="container">
        <h1>Welcome to the Home Page</h1>

        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card text-white bg-primary">
                    <p class="card-header">Total users</p>
                    <div class="card-body">
                        <h2 class="card-title">{{ $users }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card text-white bg-success">
                    <p class="card-header">Total posts</p>
                    <div class="card-body">
                        <h2 class="card-title">{{ $posts }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
