@extends('layouts.app')

@section('title', 'Users Show')

@section('content')
    <div class="container">
        <h1>User show</h1>
        {{ $user }}
    </div>
@endsection
