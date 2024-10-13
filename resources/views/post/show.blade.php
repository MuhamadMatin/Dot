@extends('layouts.app')

@section('title', 'Post Show')

@section('content')
    <div class="container">
        <h1>Post show</h1>
        {{ $post }}
    </div>
@endsection
