@extends('layouts.app')

@section('content')

<div class="jumbotron text-center">
    @if (Auth::guest())
        <h1>Welcome to Nerdsweb</h1>
        <p>This is a world Largest Blog Platform<p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a><p>
    @else
        <h1>Welcome {{ Auth::user()->name }}</h1>
        <p>This is a world wide Blog platform<p>
        <p><a class="btn btn-primary btn-lg" href="/posts/create" role="button">Create Post</a><p>
     @endif
    </div>
@endsection




